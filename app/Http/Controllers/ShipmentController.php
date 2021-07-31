<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index(){
        $units = Shipment::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
