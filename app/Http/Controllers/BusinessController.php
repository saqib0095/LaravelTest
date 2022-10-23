<?php

namespace App\Http\Controllers;

use App\Models\Business_address;
use App\Models\Business_ratings;
use App\Models\Businesses;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    //
    public function getBusinesses($id = false)
    {
        if($id){
            return Businesses::find($id);
        }
        return Businesses::all();
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'street' => 'required',
            'state' => 'required',
            'city' => 'required',
            'post_code' => 'required',
            'country' => 'required',
            //'Rating' => 'required',
            'Hygiene_status' => 'required',
            'Last_inspection' => 'required|date'
        ]);
        
        return Businesses::create($request->all());
    }
    public function update(Request $request,$id){
        $business = Businesses::find($id);
        $business->update($request->all());
        return $business;
    }
    public function destroy($id)
    {
        return Businesses::destroy($id);
    }
}
