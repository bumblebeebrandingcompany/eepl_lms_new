<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;


use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;

use App\Models\Plc;
use App\Models\PlotDetail;
use Illuminate\Http\Request;


class PlotDetailController extends Controller
{
    protected $util;
    use MediaUploadingTrait, CsvImportTrait;

    /**
     * Constructor
     *
     */
 
    
    public function store(Request $request)
    {
            $plotdetail = new PlotDetail();
            $plotdetail-> plot_no= $request->plot_no;
            $plotdetail->plot_type= $request->plot_type;
            $plotdetail->dimension_length = $request->dimension_length;
            $plotdetail->dimension_breadth = $request->dimension_breadth;
            $plotdetail->overall_sqft_price = $request->overall_sqft_price;
            $plotdetail->total_sqfts =$request->total_sqfts;
            $plotdetail->plc_values = json_encode($request->plc_values);
            $plotdetail->project_id =$request->project_id;
            $plotdetail->save();
            return redirect()->back()->with('success', 'Plot Added successfully');
    }
    public function create(Request $request)
    {
        $plcs = Plc::all();
        return view('admin.plotdetails.create',compact('plcs'));
    }
    public function edit($id)
    {
        $plotdetails=PlotDetail::findOrFail($id);
        return view('admin.plotdetails.edit',compact('plotdetails'));
    }
    public function show($id)
    {
        $plotdetail=PlotDetail::findOrFail($id);
        return view('admin.plotdetails.show',compact('plotdetail'));
    }
    public function update(Request $request, $id)
    {
            $plotdetail=PlotDetail::findOrFail($id);
            $plotdetail-> plot_no= $request->plot_no;
            $plotdetail->plot_type= $request->plot_type;
            $plotdetail->dimension_length = $request->dimension_length;
            $plotdetail->dimension_breadth = $request->dimension_breadth;
            $plotdetail->overall_sqft_price = $request->overall_sqft_price;
            $plotdetail->total_sqfts =$request->total_sqfts;
            $plotdetail->plc_values = json_encode($request->plc_values);
            $plotdetail->project_id =$request->project_id;
            $plotdetail->update();

        return redirect()->back()->with('success', 'Plot updated successfully');
    }
    public function destroy($id)
    {
        $plotdetail = PlotDetail::findOrFail($id);
        $plotdetail->delete();
        return redirect()->route('admin.price.index')->with('success', 'Walkin deleted successfully');
    }
    }