<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MerlomLead;
use App\Utils\Util;
use App\Models\Project;
use App\Models\Lead;




class MerlomLeadController extends Controller
{

    protected $util;

    /**
     * Constructor
     *
     */
    public function __construct(Util $util)
    {
        $this->util = $util;
    }
    public function index()
    {

        $merlomLeads = MerlomLead::all();
        $projects = Project::pluck('name', 'id');

        return view('admin.merlomleads.index', compact('merlomLeads'));
    }

    public function show(MerlomLead $merlomLead)

    {

        return view('admin.merlomleads.show', compact('merlomLead'));
    }


    public function create()
    {

        $project_ids = $this->util->getUserProjects(auth()->user());
        $projects = Project::whereIn('id', $project_ids)
            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $project_id = request()->get('project_id', null);
        $phone = request()->get('phone', null);
        $action = request()->get('action', null);
        return view('admin.merlomleads.create', compact('projects', 'project_id', 'phone', 'action'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'phone' => 'required|string|max:255',
            'source' => 'string|max:255',
            'sub_source' => 'string|max:255',
            'sell_do_id' => 'nullable',
            'project_id' => 'required'
        ]);

        // Check if a Lead with the given phone number exists
        $existingLead = Lead::where('phone', $request->input('phone'))->first();

        if ($existingLead) {
            // Update existing MerlomLead record with the new data
            $merlomLead = MerlomLead::updateOrCreate(
                ['sell_do_id' => $existingLead->sell_do_lead_id ?? 'null'],
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'phone' => $request->input('phone'),
                    'project_id' => $request->input('project_id'),
                    'source' => $request->input('source') ?? 'Channel Partner',
                    'sub_source' => $request->input('sub_source') ?? 'Merlom',
                    'status' => 0,

                ]

            );
            $merlomLead->ref_num = $this->util->generateCpWalkinRefNum($merlomLead);
            $merlomLead->save();
        } else {
            // Create a new MerlomLead record
            $merlomLead = MerlomLead::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'project_id' => $request->input('project_id'),
                'source' => $request->input('source') ?? 'Channel Partner',
                'sub_source' => $request->input('sub_source') ?? 'Merlom',
                'status' => 1,
            ]);
            $merlomLead->ref_num = $this->util->generateCpWalkinRefNum($merlomLead);
            $merlomLead->save();
        }

        return redirect()->route('admin.merlom-leads.index')->with('success', 'Form created successfully');
    }


    public function edit(MerlomLead $merlomLead)
    {
        $project_ids = $this->util->getUserProjects(auth()->user());
        $projects = Project::whereIn('id', $project_ids)
            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $project_id = request()->get('project_id', null);
        $phone = request()->get('phone', null);
        $action = request()->get('action', null);
        return view('admin.merlomleads.edit', compact('projects', 'project_id', 'phone', 'action','merlomLead'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'phone' => 'required|string|max:255',
            'source' => 'string|max:255',
            'sub_source' => 'string|max:255',
            'sell_do_id' => 'nullable',
            'project_id' => 'required'
        ]);

        // Find the existing MerlomLead record by ID
        $merlomLead = MerlomLead::findOrFail($id);

        // Update the MerlomLead record with the new data
        $merlomLead->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'project_id' => $request->input('project_id'),
            'source' => $request->input('source') ?? 'Channel Partner',
            'sub_source' => $request->input('sub_source') ?? 'Merlom',
            // Add any other fields you want to update
        ]);

        $merlomLead->ref_num = $this->util->generateCpWalkinRefNum($merlomLead);
        $merlomLead->save();

        return redirect()->route('admin.merlom-leads.index')->with('success', 'Form updated successfully');
    }


    public function destroy(MerlomLead $merlomLead)
    {
        $merlomLead->delete();

        return redirect()->route('admin.merlom-leads.index')->with('success', 'MerlomLead deleted successfully');
    }




}
