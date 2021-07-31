<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(){
        $units = Payment::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
