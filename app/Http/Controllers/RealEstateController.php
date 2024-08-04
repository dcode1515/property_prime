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
    public function property_view(){
        $realestate = Property::get();
        return view('realstate.property',compact('realestate'));
    }
}
