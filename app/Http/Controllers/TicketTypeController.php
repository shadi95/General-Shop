<?php

namespace App\Http\Controllers;

use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index(){
        $units = TicketType::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
