<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySourceRequest;
use App\Http\Requests\StoreSourceRequest;
use App\Http\Requests\UpdateSourceRequest;
use App\Models\Campaign;
use App\Models\Project;
use App\Models\Source;
use Gate;
use App\Models\Lead;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Utils\Util;
class SourceController extends Controller
{
    /**
    * All Utils instance.
    *
    */
    protected $util;

    /**
    * Constructor
    *
    */
    public function __construct(Util $util)
    {
        $this->util = $util;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Source::with(['project', 'campaign'])->select(sprintf('%s.*', (new Source)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'source_show';
                $editGate      = 'source_edit';
                $deleteGate    = 'source_delete';
                $webhookSecretGate = true;
                $crudRoutePart = 'sources';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'webhookSecretGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            
            $table->addColumn('project_name', function ($row) {
                return $row->project ? $row->project->name : '';
            });

            $table->addColumn('campaign_campaign_name', function ($row) {
                return $row->campaign ? $row->campaign->campaign_name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'project', 'campaign']);

            return $table->make(true);
        }

        $project_ids = $this->util->getUserProjects(auth()->user());
        $campaign_ids = $this->util->getCampaigns(auth()->user(), $project_ids);

        $projects  = Project::whereIn('id', $project_ids)
                        ->get();

        $campaigns = Campaign::whereIn('id', $campaign_ids)
                        ->get();

        return view('admin.sources.index', compact('projects', 'campaigns'));
    }

    public function create()
    {
        $project_ids = $this->util->getUserProjects(auth()->user());
        $campaign_ids = $this->util->getCampaigns(auth()->user(), $project_ids);

        $projects = Project::whereIn('id', $project_ids)
                        ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaigns = Campaign::whereIn('id', $campaign_ids)
                        ->pluck('campaign_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.sources.create', compact('campaigns', 'projects'));
    }

    public function store(StoreSourceRequest $request)
    {
        $source_details = $request->except('_token');
        $source_details['webhook_secret'] = $this->util->generateWebhookSecret();
        $source = Source::create($source_details);

        return redirect()->route('admin.sources.index');
    }

    public function edit(Source $source)
    {
        $project_ids = $this->util->getUserProjects(auth()->user());
        $campaign_ids = $this->util->getCampaigns(auth()->user(), $project_ids);

        $projects = Project::whereIn('id', $project_ids)
                        ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $campaigns = Campaign::whereIn('id', $campaign_ids)
                        ->pluck('campaign_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $source->load('project', 'campaign');

        return view('admin.sources.edit', compact('campaigns', 'projects', 'source'));
    }

    public function update(UpdateSourceRequest $request, Source $source)
    {
        $source->update($request->all());

        return redirect()->route('admin.sources.index');
    }

    public function show(Source $source)
    {

        $source->load('project', 'campaign');

        return view('admin.sources.show', compact('source'));
    }

    public function destroy(Source $source)
    {
        abort_if(!auth()->user()->is_superadmin, Response::HTTP_FORBIDDEN, '403 Forbidden');

        $source->delete();

        return back();
    }

    public function massDestroy(MassDestroySourceRequest $request)
    {
        $sources = Source::find(request('ids'));

        foreach ($sources as $source) {
            $source->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getWebhookDetails($id)
    {
        $source = Source::findOrFail($id);

        $lead =  Lead::where('source_id', $id)
                    ->latest()
                    ->first();
                    
        return view('admin.sources.webhook', compact('source', 'lead'));
    }

    public function saveOutgoingWebhookInfo(Request $request)
    {

        $id = $request->input('source_id');
        $webhook = $request->input('webhook');
        $api = $request->input('api');

        $source = Source::findOrFail($id);
        $source->outgoing_webhook = $webhook;
        $source->outgoing_apis = $api;
        $source->save();

        return redirect()->route('admin.sources.webhook', $source->id);
    }

    public function getWebhookHtml(Request $request)
    {
        if($request->ajax()) {
            $type = $request->get('type');
            $key = $request->get('key') + 1;
            if($type == 'api') {
                return view('admin.sources.partials.api_card')
                    ->with(compact('key'));
            } else {
                return view('admin.sources.partials.webhook_card')
                    ->with(compact('key'));
            }
        }
    }

    public function getSource(Request $request)
    {
        if($request->ajax()) {
            $sources = Source::where('project_id', $request->input('project_id'))
                    ->where('campaign_id', $request->input('campaign_id'))
                    ->pluck('name', 'id')
                    ->toArray();
                    
            $sources_arr = [['id' => '', 'text' => __('messages.please_select')]];
            if(!empty($sources)) {
                foreach ($sources as $id => $text) {
                    $sources_arr[] = [
                        'id' => $id,
                        'text' =>$text
                    ];
                }
            }
            return $sources_arr;
        }
    }

    public function updatePhoneAndEmailKey(Request $request)
    {
        $source = Source::findOrFail($request->input('source_id'));
        $source->email_key = $request->input('email_key');
        $source->phone_key = $request->input('phone_key');
        $source->save();

        return redirect()->route('admin.sources.webhook', $source->id);
    }
}