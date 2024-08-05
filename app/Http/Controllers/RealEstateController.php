<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property;

class RealEstateController extends Controller
{
    //

    public function index(){
        $realestate = Property::get();
        return view('realstate.index',compact('realestate'));
    }
    public function property_view($id){
        $realestate = Property::find($id);
        return view('realstate.property',compact('realestate'));
    }

    public function forrent(){
        $forrent = Property::where('type','=','For Rent')->get();
        return view('realstate.forrent',compact('forrent'));
    }
    public function forsale(){
        $forsale = Property::where('type','=','For Sale')->get();
        return view('realstate.forsale',compact('forsale'));
    }
}
