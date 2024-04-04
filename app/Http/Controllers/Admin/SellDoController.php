<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SellDo;
use App\Utils\Util;
use App\Models\Project;
use App\Models\Lead;




class SellDoController extends Controller
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

        $selldo = SellDo::all();
        $projects = Project::pluck('name', 'id');

        return view('admin.selldo.index', compact('selldo'));
    }

    public function show($id)
    {
        $selldodata=SellDo::findOrFail($id);
        return view('admin.selldo.show', compact('selldodata'));
    }


    public function create()
    {

        $project_ids = $this->util->getUserProjects(auth()->user());
        $projects = Project::whereIn('id', $project_ids)
            ->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $project_id = request()->get('project_id', null);
        $phone = request()->get('phone', null);
        $action = request()->get('action', null);
        return view('admin.selldo.create', compact('projects', 'project_id', 'phone', 'action'));
    }


    public function store(Request $request)
    {


        $request->validate([
            'name' => 'required|string|max:255',


        ]);

        $selldodata = SellDo::create([
            'name' => $request->input('name'),

        ]);



        return redirect()->route('admin.selldo.index')->with('success', 'Form created successfully');
    }
    public function edit(SellDo $selldo)
    {
        return view('admin.selldo.edit', compact('selldo'));
    }

    public function update(Request $request,SellDo $selldo)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        // Update the SellDo attributes
        $selldo->update([
            'name' => $request->input('name'),

        ]);





        return redirect()->route('admin.selldo.index')->with('success', 'Form updated successfully');
    }


    public function destroy(SellDo $selldo)
    {
        $selldo->delete();

        return redirect()->route('admin.selldo.index')->with('success', 'SellDo deleted successfully');
    }




}
