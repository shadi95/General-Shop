<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){
        $units = State::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
