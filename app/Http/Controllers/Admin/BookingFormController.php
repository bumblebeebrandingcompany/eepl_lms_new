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
use App\Models\Source;

class BookingFormController extends Controller
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
        // if (!auth()->user()->checkPermission('booking_view')) {
        //     abort(403, 'Unauthorized.');
        // }

        if ($request->ajax()) {
            $query = LeadEvents::where('event_type', 'booking_created')
                ->join('leads', 'lead_events.lead_id', '=', 'leads.id')
                ->leftJoin('projects', 'lead_events.project_id', '=', 'projects.id')
                ->select([
                    'lead_events.id',
                    'lead_events.lead_id',
                    'lead_events.created_at',
                    'leads.ref_num',
                    'leads.name as lead_name',
                    'projects.name as project_name'
                ]);

            if (!auth()->user()->is_superadmin) {
                $query->where('lead_events.created_by', auth()->user()->id);
            }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = auth()->user()->checkPermission('booking_show');
                $editGate = auth()->user()->checkPermission('booking_edit');
                $deleteGate = auth()->user()->checkPermission('booking_delete');
                $crudRoutePart = 'bookings';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                )
                );
            });

            $table->addColumn('project_name', function ($row) {
                return $row->project_name ? $row->project_name : '';
            });

            $table->editColumn('lead_name', function ($row) {
                $lead = $row->lead_name ? $row->lead_name : '';
                if (!empty($row->ref_num)) {
                    $lead .= '<small>(<code>' . $row->ref_num . '</code>)</small>';
                }
                return $lead;
            });

            $table->editColumn('created_at', '{{@format_datetime($created_at)}}');

            $table->rawColumns(['actions', 'placeholder', 'project_name', 'lead_name', 'created_at']);

            $table->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search_term = request('search.value');
                    $query->where(function ($q) use ($search_term) {
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

        return view('admin.bookings.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // if (!auth()->user()->checkPermission('booking_create')) {
        //     abort(403, 'Unauthorized.');
        // }

        $project_ids = $this->util->getUserProjects(auth()->user());
        $projects = Project::whereIn('id', $project_ids)
            ->pluck('name', 'id')
            ->toArray();

        $phone = request()->get('phone', null);

        return view('admin.bookings.create')
            ->with(compact('projects', 'phone'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if (!auth()->user()->checkPermission('bookings_create')) {
        //     abort(403, 'Unauthorized.');
        // }

        try {
            DB::beginTransaction();

            $lead_id = $request->input('lead_id');
            $input = $request->only(['additional_email', 'secondary_phone']);
            $lead_details = $request->input('lead_details');

            // update lead details
            $lead = Lead::findOrFail($lead_id);
            $input['lead_details'] = !empty($lead->lead_info) ? array_merge($lead->lead_info, $lead_details) : $lead_details;
            $lead->update($input);

            $webhook_data = [
                'source_id' => $request->input('source_id'),
                'sub_source' => $request->input('sub_source'),
                'dob' => $request->input('dob'),
                'campaign_id' => $request->input('campaign_id'),
                'details_of_co_applicant' => $request->input('details_of_co_applicant'),
                'Plot_Details' => $request->input('Plot_Details'),
                'Booking_Application_Date' => $request->input('Booking_Application_Date'),
                'Loan' => $request->input('Loan'),
                'Type_of_Buyer'=>$request->input('Type_of_Buyer'),
                'Advance_Amount' => $request->input('Advance_Amount'),
                'Financing_Plan' => $request->input('Financing_Plan'),
                'Sales_Person_Details' => $request->input('Sales_Person_Details'),
                'other' => $request->input('other')
            ];

            LeadEvents::create([
                'source' => 'leads_system',
                'sell_do_lead_id' => $lead->sell_do_lead_id,
                'lead_id' => $lead->id,
                'event_type' => 'booking_created',
                'created_by' => auth()->user()->id,
                'webhook_data' => $webhook_data,
                'project_id' => $request->input('project_id', 1)
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $msg = 'File:' . $e->getFile() . ' | Line:' . $e->getLine() . ' | Message:' . $e->getMessage();
            \Log::info('bookings store:- ' . $msg);
        }
        return redirect()->route('admin.bookings.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // if (!auth()->user()->checkPermission('bookings_view')) {
        //     abort(403, 'Unauthorized.');
        // }

        $query = LeadEvents::with('lead', 'project');

        if (!auth()->user()->is_superadmin) {
            $query->where('lead_events.created_by', auth()->user()->id);
        }

        $event = $query->findOrFail($id);

        return view('admin.bookings.show')
            ->with(compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // if (!auth()->user()->checkPermission('bookings_edit')) {
        //     abort(403, 'Unauthorized.');
        // }

        $lead_event = LeadEvents::with('lead')->findOrFail($id);

        $project_ids = $this->util->getUserProjects(auth()->user());
        $projects = Project::whereIn('id', $project_ids)
            ->pluck('name', 'id')
            ->toArray();

        $campaigns = Campaign::where('project_id', 1)
            ->pluck('campaign_name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        $sources = Source::where('project_id', 1)
            ->pluck('name', 'id')
            ->prepend(trans('global.pleaseSelect'), '');

        return view('admin.bookings.edit')
            ->with(compact('lead_event', 'projects', 'campaigns', 'sources'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // if (!auth()->user()->checkPermission('bookings_edit')) {
        //     abort(403, 'Unauthorized.');
        // }

        try {
            DB::beginTransaction();

            $input = $request->only(['additional_email', 'secondary_phone']);
            $lead_details = $request->input('lead_details');
            $webhook_data = [
                'source_id' => $request->input('source_id'),
                'sub_source' => $request->input('sub_source'),
                'dob' => $request->input('dob'),
                'campaign_id' => $request->input('campaign_id'),
                'details_of_co_applicant' => $request->input('details_of_co_applicant'),
                'Plot_Details' => $request->input('Plot_Details'),
                'EOI_Application_Date' => $request->input('EOI_Application_Date'),
                'Loan' => $request->input('Loan'),
                'Advance_Amount' => $request->input('Advance_Amount'),
                'Financing_Plan' => $request->input('Financing_Plan'),
                'Sales_Person_Details' => $request->input('Sales_Person_Details'),
                'Type_of_Buyer'=>$request->input('Type_of_Buyer'),
                'other' => $request->input('other')
            ];

            // update lead details
            $lead = Lead::findOrFail($id);
            $input['lead_details'] = !empty($lead->lead_info) ? array_merge($lead->lead_info, $lead_details) : $lead_details;
            $lead->update($input);

            LeadEvents::where('lead_id', $id)
                ->where('id', $request->input('lead_event_id'))
                ->update([
                    'webhook_data' => $webhook_data,
                    'project_id' => $request->input('project_id', 1)
                ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $msg = 'File:' . $e->getFile() . ' | Line:' . $e->getLine() . ' | Message:' . $e->getMessage();
            \Log::info('bookings edit:- ' . $msg);
        }
        return redirect()->route('admin.bookings.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // if (!auth()->user()->checkPermission('bookings_delete')) {
        //     abort(403, 'Unauthorized.');
        // }

        $event = LeadEvents::findOrFail($id);

        $event->delete();

        return back();
    }

    public function massDestroy(MassDestroyFOIRequest $request)
    {
        // if (!auth()->user()->checkPermission('bookings_delete')) {
        //     abort(403, 'Unauthorized.');
        // }

        $events = LeadEvents::find(request('ids'));

        foreach ($events as $event) {
            $event->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function getLeadDetails(Request $request)
    {
        if ($request->ajax()) {
            $searchTerm = $request->input('search_term');
            $projectId = $request->input('project_id'); 
    
            $leadsQuery = Lead::where(function ($query) use ($searchTerm) {
                $query->whereJsonContains('essential_fields->Phone Number', $searchTerm)
                      ->orWhereJsonContains('essential_fields->Addl Number', $searchTerm);
            });
            
    
            if ($projectId != 'all') {
                $leadsQuery->where('project_id', $projectId);
            }
    
            $lead = $leadsQuery->first(); // Retrieve the first matching lead
    
            if ($projectId != 'all') {
                $msg = "Lead is not found with this number. Please create a new enquiry";
                $redirectUrl = route('admin.aztec.create', ['project_id' => $projectId, 'phone' => $searchTerm, 'action' => 'cbookings']);
            } else {
                $msg = "Lead is not found with this number. Please create a new lead";
                $redirectUrl = route('admin.leads.create', ['project_id' => $projectId, 'phone' => $searchTerm, 'action' => 'default_action']);
            }
    
            if (!$lead) { // Check if lead is not found
                return [
                    'msg' => $msg,
                    'success' => false,
                    'redirect_url' => $redirectUrl
                ];
            }
    
            // If lead is found, continue with other logic
    
            $projectIds = $this->util->getUserProjects(auth()->user());
            $projects = Project::whereIn('id', $projectIds)
                ->pluck('name', 'id')
                ->toArray();
    
            $campaigns = Campaign::where('project_id', $projectId)
                ->pluck('campaign_name', 'id')
                ->prepend(trans('global.pleaseSelect'), '');
    
            $sources = Source::where('project_id', $projectId)
                ->pluck('name', 'id')
                ->prepend(trans('global.pleaseSelect'), '');
                $html = View::make('admin.bookings.partials.sell_do_and_lead_info', [
                    'lead' => $lead,
                    'projects' => $projects,
                    'campaigns' => $campaigns,
                    'sources' => $sources
                ])->render();
            return [
                'success' => true,
                'html' => $html, // Optionally return HTML if needed
            ];
        }
    }


}
