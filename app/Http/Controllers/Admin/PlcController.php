<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plc;
use Illuminate\Http\Request;


class PlcController extends Controller
{
    public function index()
    {
        $plcs = Plc::all();
        return view('admin.plcs.index', compact('plcs'));
    }

    public function create()
    {
        $plcs = Plc::all();
        return view('admin.plcs.create', compact('plcs'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'tag' => 'required',
            'increment/decrement' => 'required|integer',
            'project_id' => 'required|integer',
        ]);

        // Create new PLC
        Plc::create($validatedData);

        return redirect()->back();
    }
}

