<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::paginate(env("PAGINATION_COUNT"));
        return view('admin.categories.categories')->with([
            'showLinks' => true,
            'categories' => $categories]);
    } 

    // Add New Category //
    public function store( Request $request ){
        // Check parameter validate 
        $request->validate([
            'category_name' => 'required'
        ]);
        // Check If the Category is Exists or Not 
        $categoryName = $request->input('category_name');
        $category = Category::where( 'name', '=', $categoryName )->get();
        if( count( $category ) > 0 ){
            Session::flash( 'message', 'category ' . $categoryName . ' Already Exists');
            return redirect()->back();
        }
        // Then If The Category Not Exists Save It In Database
        $newcategory = new Category();
        $newcategory->name = $categoryName;
        $newcategory->save();
        Session::flash('message', 'Category '  . $categoryName . ' has been added' );
        return redirect()->back();
    }

    // Delete Category //
    public function delete ( Request $request) {
        $request->validate([
            'category_id' => 'required'
        ]);
        $categoryID = $request->input('category_id');
        $Category = Category::destroy( $categoryID);
        Session::flash('message', 'Category has been deleted' );
        return redirect()->back();
    }

    // Check IF Category Name Exists //
    private function CategoryNameExists( $categoryName ){
        $category =  Category::where( 'name', '=', $categoryName )->first();
        if( !is_null( $category ) ){
             return false;
        }
        return true;
    }

    // Update Category //
    public function update (Request $request) {
        $request->validate([
            'category_id' => 'required',
            'category_name' => 'required'
        ]);
        $categoryName = $request->input('category_name');
        $categorygID = $request->input('category_id');

        if( ! $this->categoryNameExists( $categoryName) ){
            Session()->flash('message', 'Category Name already exists');
            return redirect()->back();
        }       
        // Update Category In Database        
        $category = Category::find( $categorygID);
        $category->name = $categoryName;
        $category->save();
        // Flash Message on Category Actions
        Session()->flash('message', 'Category has been Updated!');
        return redirect()->back();
    }

    // Category Search //
    public function search( Request $request ){
        // Check Category Input Validate   
        $request->validate([
            'category_search' => 'required',            
        ]);
        // Category Search In Database 
        $serachTerm = $request->input('category_search');
        $categories = Category::where( 
            'name', 'LIKE', '%' . $serachTerm . '%'
        )->get();
        // Enable Search Results on Pagination in View
        if( count( $categories ) > 0 ){
            return view( 'admin.categories.categories')->with([
                'categories'     => $categories,
                'showLinks' => false,
            ]);
        }
        // Flash Message on Category Actions
        Session::flash('message', 'Nothing Found!!!');
        return redirect()->back();
        
    }
}
