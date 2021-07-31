<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(){
        $units = Ticket::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
