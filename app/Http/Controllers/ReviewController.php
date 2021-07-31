<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $units = Review::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
