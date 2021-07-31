<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(){
        $units = Address::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
