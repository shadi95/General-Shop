<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $units = Order::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
