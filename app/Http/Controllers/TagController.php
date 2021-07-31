<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(){
        $units = Tag::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
