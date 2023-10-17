<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAgencyRequest;
use App\Http\Requests\StoreAgencyRequest;
use App\Http\Requests\UpdateAgencyRequest;
use App\Models\Agency;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AgencyController extends Controller
{
    public function index(Request $request)
    {
        if(!auth()->user()->checkPermission('agency_view')){
            abort(403, 'Unauthorized.');
        }

        if ($request->ajax()) {
            $query = Agency::query()->select(sprintf('%s.*', (new Agency)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = auth()->user()->checkPermission('agency_view');
                $editGate      = auth()->user()->checkPermission('agency_edit');
                $deleteGate    = auth()->user()->checkPermission('agency_delete');
                $crudRoutePart = 'agencies';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('contact_number_1', function ($row) {
                return $row->contact_number_1 ? $row->contact_number_1 : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.agencies.index');
    }

    public function create()
    {
        if(!auth()->user()->checkPermission('agency_create')){
            abort(403, 'Unauthorized.');
        }
        return view('admin.agencies.create');
    }

    public function store(StoreAgencyRequest $request)
    {
        $agency = Agency::create($request->all());

        return redirect()->route('admin.agencies.index');
    }

    public function edit(Agency $agency)
    {
        if(!auth()->user()->checkPermission('agency_edit')){
            abort(403, 'Unauthorized.');
        }

        return view('admin.agencies.edit', compact('agency'));
    }

    public function update(UpdateAgencyRequest $request, Agency $agency)
    {
        $agency->update($request->all());

        return redirect()->route('admin.agencies.index');
    }

    public function show(Agency $agency)
    {
        if(!auth()->user()->checkPermission('agency_view')){
            abort(403, 'Unauthorized.');
        }

        $agency->load('agencyUsers', 'agencyCampaigns');

        return view('admin.agencies.show', compact('agency'));
    }

    public function destroy(Agency $agency)
    {
        if(!auth()->user()->checkPermission('agency_delete')){
            abort(403, 'Unauthorized.');
        }

        $agency->delete();

        return back();
    }

    public function massDestroy(MassDestroyAgencyRequest $request)
    {
        $agencies = Agency::find(request('ids'));

        foreach ($agencies as $agency) {
            $agency->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
