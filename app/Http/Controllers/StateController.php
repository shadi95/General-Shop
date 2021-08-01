<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(){
        $states = State::paginate(20);
        return view('admin.states.states')->with(['states' => $states]);
    }
}
