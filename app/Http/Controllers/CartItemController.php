<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;

class CartItemController extends Controller
{
    public function index(){
        $units = CartItem::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
