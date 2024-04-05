<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Price;
use App\Models\Plc;
use App\Models\User;

use Illuminate\Http\Request;
class PriceController extends Controller
{
    protected $util;

    /**
     * Constructor
     *
     */
 
    public function index()
    {
       $price=Price::all();
       $plcs=Plc::all();
        return view('admin.price.index',compact('price','plcs'));
        
    }
    public function store(Request $request)
    {
            $price = new Price();
            $price-> user_type= $request->user_type;
            $price->price_per_sqft= $request->price_per_sqft;
            $price->date = $request->date;
            $price->project_id= $request->project_id;

            $price->save();
    }
    public function create(Request $request)
    {
        $users=User::all();
        return view('admin.price.create');
    }
    public function edit($id)
    {
        $price=Price::findOrFail($id);

        return view('admin.price.edit',compact('price'));
    }
    public function show($id)
    {
        $price=Price::findOrFail($id);

        return view('admin.price.show',compact('price'));
    }
    public function update(Request $request, $id)
    {
        $price=Price::findOrFail($id);
        $price-> user_type= $request->user_type;
        $price->price_per_sqft= $request->price_per_sqft;
        $price->project_id= $request->project_id;

        $price->date = $request->date;
            $price->update();
        return redirect()->back();
    }
    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();
        return redirect()->route('admin.price.index')->with('success', 'Walkin deleted successfully');
    }
    }