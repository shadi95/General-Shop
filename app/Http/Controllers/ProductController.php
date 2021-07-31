<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(env("PAGINATION_COUNT"));   
        $currencyCode = env("CURRENCY_CODE", "$");  // Here define the variable in env file because its faster to load and use it over the application   
        return view('admin.products.products')->with([
            'products'       => $products,
            "currencyCode"   => $currencyCode,        
        ]); 
        
    }
}
