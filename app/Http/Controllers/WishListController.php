<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;

class WishListController extends Controller
{
    public function index(){
        $units = WishList::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
