<?php

namespace App\Http\Controllers;

use App\Models\Businesses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function RegionSearch(Request $request)
    {
        if($request->ajax()){
            $region = $request->region ?? '';
            $businessName = $request->businessName ?? '';
            $businessType = $request->businessType ?? '';
            $country = $request->country ?? '';

            $data = Businesses::join('business_addresses as a','a.business_id','=','Businesses.id')
                                ->join('business_ratings as r','r.business_id','=','Businesses.id');
            if($region != ''){
                $data = Businesses::where('city','=',$request->region);
            }
            if($businessName != ''){
                $data = Businesses::where('name','=',$businessName);
            }
            if($businessType != ''){
                $data = Businesses::where('type','=',$businessType);
            }
            if($country != ''){
                $data = Businesses::where('country','=',$country);
            }
            $data = $data->get(['name','Rating','Last_inspection']); 
            
            return ['tableData' => $data];
        }
        return view('home');
    }
}
