<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $units = Cart::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
