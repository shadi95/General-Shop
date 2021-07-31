<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(20); 
        return view('admin.products.products')->with(['products' => $products]); 
    }
}
