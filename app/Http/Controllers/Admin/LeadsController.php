<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLeadRequest;
use App\Http\Requests\StoreLeadRequest;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Campaign;
use App\Models\Lead;
use App\Models\Project;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\Util;
use App\Models\Source;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use App\Exports\LeadsExport;
use App\Models\Document;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\LeadEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LeadDocumentShare;
use Exception;

class LeadsController extends Controller
{
    /**
     * All Utils instance.
     *
     */
    protected $util;
    protected $lead_view;
    /**
     * Constructor
     *
     */
    public function __construct(Util $util)
    {
        $this->util = $util;
        $this->lead_view = ['list', 'kanban'];
    }

    public function index(Request $request)
    {
       
        $projects = Project::all();
      
            return view('admin.leads.index', compact('projects'));
        }
    

    public function create()
    {
        if (!auth()->user()->checkPermission('lead_create')) {
            abort(403, 'Unauthorized.');
        }

        if (
            auth()->user()->is_site_executive &&
            (
                empty(request()->get('project_id')) ||
                empty(request()->get('phone')) ||
                (
                    empty(request()->get('action')) ||
                    (
                        !empty(request()->get('action')) &&
                        request()->get('action') != 'ceoi'
                    )
                )
            )
        ) {
            abort(403, 'Unauthorized.');
        }

        $project_ids = $this->util->getUserProjects(auth()->user());
        $campaign_ids = $this->util->getCampaigns(auth()->user());

        $projects = Project::whereIn('id', $project_ids)
            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaigns = Campaign::whereIn('id', $campaign_ids)
            ->pluck('campaign_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $project_id = request()->get('project_id', null);
        $phone = request()->get('phone', null);
        $action = request()->get('action', null);

        return view('admin.leads.create', compact('campaigns', 'projects', 'project_id', 'phone', 'action'));
    }

    public function store(StoreLeadRequest $request)
    {
        $input = $request->except(['_method', '_token', 'redirect_to']);
        $input['lead_details'] = $this->getLeadDetailsKeyValuePair($input['lead_details'] ?? []);
        $input['created_by'] = auth()->user()->id;

        /*
         * set default source if lead
         * added by channel partner
         */
        $source = Source::where('is_cp_source', 1)
            ->where('project_id', $input['project_id'])
            ->first();

        if (auth()->user()->is_channel_partner && !empty($source)) {
            $input['source_id'] = $source->id;
        }

        $lead = Lead::create($input);
        $lead->ref_num = $this->util->generateLeadRefNum($lead);
        $lead->save();

        $this->util->storeUniqueWebhookFields($lead);
        if (!empty($lead->project->outgoing_apis)) {
            $this->util->sendApiWebhook($lead->id);
        }

        if (!empty($request->get('redirect_to')) && $request->get('redirect_to') == 'ceoi') {
            return redirect()->route('admin.eoi.create', ['phone' => $lead->phone]);
        }

        return redirect()->route('admin.leads.index');
    }

    public function edit(Lead $lead)
    {
        if (!auth()->user()->checkPermission('lead_edit')) {
            abort(403, 'Unauthorized.');
        }

        $project_ids = $this->util->getUserProjects(auth()->user());
        $campaign_ids = $this->util->getCampaigns(auth()->user(), $project_ids);

        $projects = Project::whereIn('id', $project_ids)
            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaigns = Campaign::whereIn('id', $campaign_ids)
            ->pluck('campaign_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $lead->load('project', 'campaign');

        return view('admin.leads.edit', compact('campaigns', 'lead', 'projects'));
    }

    public function leadIndex(Request $request,$id)
    {
        if (!auth()->user()->checkPermission('lead_view')) {
            abort(403, 'Unauthorized.');
        }

        $lead_view = empty($request->view) ? 'list' : (in_array($request->view, $this->lead_view) ? $request->view : 'list');
        $__global_clients_filter = $this->util->getGlobalClientsFilter();
        if (!empty($__global_clients_filter)) {
            $project_ids = $this->util->getClientsProjects($__global_clients_filter);
            $campaign_ids = $this->util->getClientsCampaigns($__global_clients_filter);
        } else {
            $project_ids = $this->util->getUserProjects(auth()->user());
            $campaign_ids = $this->util->getCampaigns(auth()->user(), $project_ids);
        }

       
$project=Project::findOrFail($id);
        $projects = Project::whereIn('id', $project_ids)
            ->get();
            $project = Project::findOrFail($id);
        $campaigns = Campaign::whereIn('id', $campaign_ids)
            ->get();

        $sources = Source::whereIn('project_id', $project_ids)
            ->whereIn('campaign_id', $campaign_ids)
            ->get();
        $leads = Lead::where('project_id',$project->id)->get();
        if (in_array($lead_view, ['list'])) {
            return view('admin.leads.leads', compact('projects', 'campaigns', 'sources', 'lead_view', 'leads','project'));
        } else {
            $stage_wise_leads = $this->util->getFIlteredLeads($request)->get()->groupBy('sell_do_stage');
            $lead_stages = Lead::getStages();
            $filters = $request->except(['view']);
            return view('admin.leads.kanban_index', compact('projects', 'campaigns', 'sources', 'lead_view', 'stage_wise_leads', 'lead_stages', 'filters'));
        }
    }

    public function update(UpdateLeadRequest $request, Lead $lead)
    {
        $input = $request->except(['_method', '_token']);
        $input['lead_details'] = $this->getLeadDetailsKeyValuePair($input['lead_details'] ?? []);

        $lead->update($input);
        $this->util->storeUniqueWebhookFields($lead);

        return redirect()->route('admin.leads.index');
    }

    public function show(Lead $lead)
    {
        if (
            !auth()->user()->checkPermission('lead_view') ||
            (
                in_array(auth()->user()->user_type, ['lead_view_own_only', 'CRMHead']) &&
                auth()->user()->checkPermission('lead_view_own_only') &&
                ($lead->created_by != auth()->user()->id)
            )
        ) {
            abort(403, 'Unauthorized.');
        }

        $lead->load('project', 'campaign', 'source', 'createdBy');

        $lead_events = LeadEvents::where('lead_id', $lead->id)
            ->select('event_type', 'webhook_data', 'created_at as added_at', 'source')
            ->orderBy('added_at', 'desc')
            ->get();

        $project_ids = $this->util->getUserProjects(auth()->user());
        $projects_list = Project::whereIn('id', $project_ids)->pluck('name', 'id')
            ->toArray();

        return view('admin.leads.show', compact('lead', 'lead_events', 'projects_list'));
    }

    public function destroy(Lead $lead)
    {
        if (!auth()->user()->checkPermission('lead_delete')) {
            abort(403, 'Unauthorized.');
        }

        $lead->delete();

        return back();
    }

    public function massDestroy(MassDestroyLeadRequest $request)
    {
        if (!auth()->user()->checkPermission('lead_delete')) {
            abort(403, 'Unauthorized.');
        }

        $leads = Lead::find(request('ids'));

        foreach ($leads as $lead) {
            $lead->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getLeadDetailHtml(Request $request)
    {
        if ($request->ajax()) {
            $index = $request->get('index') + 1;
            if (empty($request->get('project_id'))) {
                return view('admin.leads.partials.lead_detail')
                    ->with(compact('index'));
            } else {
                $project = Project::findOrFail($request->get('project_id'));
                $webhook_fields = $project->webhook_fields ?? [];
                return view('admin.leads.partials.lead_detail')
                    ->with(compact('index', 'webhook_fields'));
            }
        }
    }

    public function getLeadDetailsKeyValuePair($lead_details_arr)
    {
        if (!empty($lead_details_arr)) {
            $lead_details = [];
            foreach ($lead_details_arr as $lead_detail) {
                if (isset($lead_detail['key']) && !empty($lead_detail['key'])) {
                    $lead_details[$lead_detail['key']] = $lead_detail['value'] ?? '';
                }
            }
            return $lead_details;
        }
        return [];
    }

    public function getLeadDetailsRows(Request $request)
    {
        if ($request->ajax()) {

            $lead_details = [];
            $project_id = $request->input('project_id');
            $lead_id = $request->input('lead_id');
            $project = Project::findOrFail($project_id);
            $webhook_fields = $project->webhook_fields ?? [];

            if (!empty($lead_id)) {
                $lead = Lead::findOrFail($lead_id);
                $lead_details = $lead->lead_info;
            }

            $html = View::make('admin.leads.partials.lead_details_rows')
                ->with(compact('webhook_fields', 'lead_details'))
                ->render();

            return [
                'html' => $html,
                'count' => !empty($webhook_fields) ? count($webhook_fields) - 1 : 0
            ];
        }
    }

    public function sendMassWebhook(Request $request)
    {
        if ($request->ajax()) {
            $lead_ids = $request->input('lead_ids');
            if (!empty($lead_ids)) {
                $response = [];
                foreach ($lead_ids as $id) {
                    $response = $this->util->sendApiWebhook($id);
                }
                return $response;
            }
        }
    }

    public function export(Request $request)
    {
        if (!auth()->user()->is_superadmin) {
            abort(403, 'Unauthorized.');
        }

        return Excel::download(new LeadsExport($request), 'leads.xlsx');
    }

    public function shareDocument(Request $request, $lead_id, $doc_id)
    {
        $lead = Lead::findOrFail($lead_id);
        $document = Document::findOrFail($doc_id);
        $note = $request->input('note');
        try {
            $mails = [];
            if (!empty($lead->email)) {
                $mails[$lead->email] = $lead->name ?? $lead->ref_num;
            }

            if (!empty($lead->additional_email)) {
                $mails[$lead->additional_email] = $lead->name ?? $lead->ref_num;
            }

            if (!empty($mails)) {
                Notification::route('mail', $mails)->notify(new LeadDocumentShare($lead, $document, auth()->user(), $note));
                $this->util->logActivity($lead, 'document_sent', ['sent_by' => auth()->user()->id, 'document_id' => $doc_id, 'status' => 'sent', 'datetime' => Carbon::now()->toDateTimeString(), 'note' => $note]);
            }
            $output = ['success' => true, 'msg' => __('messages.success')];
        } catch (Exception $e) {
            $this->util->logActivity($lead, 'document_sent', ['sent_by' => auth()->user()->id, 'document_id' => $doc_id, 'status' => 'failed', 'datetime' => Carbon::now()->toDateTimeString(), 'note' => $note]);
            $output = ['success' => false, 'msg' => __('messages.something_went_wrong')];
        }
        return $output;
    }
}
