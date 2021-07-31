<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class Unitcontroller extends Controller
{
    public function index(){
        $units = Unit::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
