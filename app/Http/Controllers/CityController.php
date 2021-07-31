<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $units = City::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
