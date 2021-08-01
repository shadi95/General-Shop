<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(){
        $reviews = Review::with(['customer'])-> paginate(20);
        return view('admin.reviews.reviews')->with(['reviews' => $reviews]);
    }
}
