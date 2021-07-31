<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index(){
        $units = Image::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
