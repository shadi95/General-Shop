<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::paginate(20);
        return view('admin.cities.cities')->with(['cities' => $cities]);
    }
}
