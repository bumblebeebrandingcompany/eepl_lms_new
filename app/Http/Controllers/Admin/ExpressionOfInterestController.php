<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Utils\Util;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Models\LeadEvents;
use App\Models\Lead;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyFOIRequest;
use View;
use App\Models\Campaign;
class ExpressionOfInterestController extends Controller
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

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(!auth()->user()->checkPermission('eoi_view')){
            abort(403, 'Unauthorized.');
        }

        if ($request->ajax()) {
            $query = LeadEvents::where('event_type', 'expression_of_interest')
                        ->join('leads', 'lead_events.lead_id', '=', 'leads.id')
                        ->leftJoin('projects', 'leads.project_id', '=', 'projects.id')
                        ->select(['lead_events.id', 'lead_events.lead_id', 'lead_events.created_at',
                        'leads.ref_num', 'leads.name as lead_name', 'projects.name as project_name']);

            if(!auth()->user()->is_superadmin) {
                $query->where('lead_events.created_by', auth()->user()->id);
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = auth()->user()->checkPermission('eoi_view');
                $editGate      = auth()->user()->checkPermission('eoi_edit');
                $deleteGate    = auth()->user()->checkPermission('eoi_delete');
                $crudRoutePart = 'eoi';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            
            $table->addColumn('project_name', function ($row) {
                return $row->project_name ? $row->project_name : '';
            });

            $table->editColumn('lead_name', function ($row) {
                $lead = $row->lead_name ? $row->lead_name : '';
                if(!empty($row->ref_num)) {
                    $lead .= '<small>(<code>'.$row->ref_num.'</code>)</small>';
                }
                return $lead;
            });

            $table->editColumn('created_at', '{{@format_datetime($created_at)}}');

            $table->rawColumns(['actions', 'placeholder', 'project_name', 'lead_name', 'created_at']);

            $table->filter(function($query) {
                if(request()->has('search') && !empty(request('search.value'))) {
                    $search_term = request('search.value');
                    $query->where(function($q) use($search_term) {
                        $q->where('lead_events.webhook_data', 'like', "%" . $search_term . "%")
                            ->orWhere('lead_events.sell_do_lead_id', 'like', "%" . $search_term . "%")
                            ->orWhere('leads.ref_num', 'like', "%" . $search_term . "%")
                            ->orWhere('leads.name', 'like', "%" . $search_term . "%")
                            ->orWhere('projects.name', 'like', "%" . $search_term . "%");
                    });
                }
            });

            return $table->make(true);
        }

        return view('admin.eoi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->checkPermission('eoi_create')){
            abort(403, 'Unauthorized.');
        }

        $project_ids = $this->util->getUserProjects(auth()->user());
        $projects = Project::whereIn('id', $project_ids)
                    ->pluck('name', 'id')
                    ->toArray();

        $phone = request()->get('phone', null);

        return view('admin.eoi.create')
            ->with(compact('projects', 'phone'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!auth()->user()->checkPermission('eoi_create')){
            abort(403, 'Unauthorized.');
        }

        try {
            DB::beginTransaction();

            $lead_id = $request->input('lead_id');
            $input = $request->only(['project_id', 'name', 'email', 'additional_email', 'phone', 'secondary_phone']);
            $lead_details = $request->input('lead_details');
            
            // update lead details
            $lead = Lead::findOrFail($lead_id);
            $lead_details = !empty($lead->lead_info) ? array_merge($lead->lead_info, $lead_details) : $lead_details;
            $lead->update(['lead_details' => $lead_details]);

            $webhook_data = [
                'details_of_co_applicant' => $request->input('details_of_co_applicant'),
                'Plot_Details' => $request->input('Plot_Details'),
                'Application_Details' => $request->input('Application_Details'),
                'Loan' => $request->input('Loan'),
                'Advance_Amount' => $request->input('Advance_Amount'),
                'Financing_Plan' => $request->input('Financing_Plan'),
                'Sales_Person_Details' => $request->input('Sales_Person_Details'),
                'other' => $request->input('other')
            ];

            LeadEvents::create([
                'source' => 'leads_system',
                'sell_do_lead_id' => $lead->sell_do_lead_id,
                'lead_id' => $lead->id,
                'event_type' => 'expression_of_interest',
                'created_by' => auth()->user()->id,
                'webhook_data' => $webhook_data
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $msg = 'File:'.$e->getFile().' | Line:'.$e->getLine().' | Message:'.$e->getMessage();
            \Log::info('eoi store:- '.$msg);
        }
        return redirect()->route('admin.eoi.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->checkPermission('eoi_view')){
            abort(403, 'Unauthorized.');
        }

        $query = LeadEvents::with('lead', 'lead.project');
        
        if(!auth()->user()->is_superadmin) {
            $query->where('lead_events.created_by', auth()->user()->id);
        }

        $event = $query->findOrFail($id);

        return view('admin.eoi.show')
            ->with(compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!auth()->user()->checkPermission('eoi_edit')){
            abort(403, 'Unauthorized.');
        }

        $lead_event = LeadEvents::with('lead')->findOrFail($id);

        $project_ids = $this->util->getUserProjects(auth()->user());
        $projects = Project::whereIn('id', $project_ids)
                    ->pluck('name', 'id')
                    ->toArray();

        return view('admin.eoi.edit')
            ->with(compact('lead_event', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!auth()->user()->checkPermission('eoi_edit')){
            abort(403, 'Unauthorized.');
        }

        try {
            DB::beginTransaction();

            $input = $request->only(['project_id', 'name', 'email', 'additional_email', 'phone', 'secondary_phone']);
            $lead_details = $request->input('lead_details');
            $webhook_data = [
                'details_of_co_applicant' => $request->input('details_of_co_applicant'),
                'Plot_Details' => $request->input('Plot_Details'),
                'Application_Details' => $request->input('Application_Details'),
                'Loan' => $request->input('Loan'),
                'Advance_Amount' => $request->input('Advance_Amount'),
                'Financing_Plan' => $request->input('Financing_Plan'),
                'Sales_Person_Details' => $request->input('Sales_Person_Details'),
                'other' => $request->input('other')
            ];

            // update lead details
            $lead = Lead::findOrFail($id);
            $lead_details = !empty($lead->lead_info) ? array_merge($lead->lead_info, $lead_details) : $lead_details;
            $lead->update(['lead_details' => $lead_details]);

            LeadEvents::where('lead_id', $id)
                ->where('id', $request->input('lead_event_id'))
                ->update([
                    'webhook_data' => $webhook_data
                ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $msg = 'File:'.$e->getFile().' | Line:'.$e->getLine().' | Message:'.$e->getMessage();
            \Log::info('eoi edit:- '.$msg);
        }
        return redirect()->route('admin.eoi.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->checkPermission('eoi_delete')){
            abort(403, 'Unauthorized.');
        }

        $event = LeadEvents::findOrFail($id);

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyFOIRequest $request)
    {
        if(!auth()->user()->checkPermission('eoi_delete')){
            abort(403, 'Unauthorized.');
        }

        $events = LeadEvents::find(request('ids'));

        foreach ($events as $event) {
            $event->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getLeadDetails(Request $request)
    {
        if($request->ajax()) {
            $search_term = $request->input('search_term');
            $project_id = $request->input('project_id');

            $lead = Lead::where('project_id', $project_id)
                    ->where(function ($query) use($search_term) {
                        $query->where('phone', 'like', '%'.$search_term.'%')
                            ->orWhere('secondary_phone', 'like', '%'.$search_term.'%');
                    })
                    ->first();
            
            if(empty($lead)) {
                return [
                    'msg' => 'Lead is not found with this number. Please create a new lead.',
                    'success' => false,
                    'redirect_url' => route('admin.leads.create', ['project_id' => 9, 'phone' => $search_term, 'action' => 'cfoi'])
                ];
            }

            $html = View::make('admin.eoi.partials.basic_details_of_applicant', ['lead' => $lead])
                    ->render();
            return [
                'html' => $html,
                'success' => true
            ];
        }
    }
}
