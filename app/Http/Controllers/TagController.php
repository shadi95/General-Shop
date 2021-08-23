<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class TagController extends Controller
{
    public function index(){
        $tags = Tag::paginate(env("PAGINATION_COUNT"));
        return view('admin.tags.tags')->with([
            'showLinks' => true,
            'tags' => $tags]);
    }

    // Add New Tag //
    public function store( Request $request ){
        // Check parameter validate 
        $request->validate([
            'tag_name' => 'required'
        ]);
        // Check If the Tag is Exists or Not 
        $tagName = $request->input('tag_name');
        $tag = Tag::where( 'tag', '=', $tagName )->get();
        if( count( $tag ) > 0 ){
            Session::flash( 'message', 'tag ' . $tagName . ' Already Exists');
            return redirect()->back();
        }
        // Then If The Tag Not Exists Save It In Database
        $newTag = new Tag();
        $newTag->tag = $tagName;
        $newTag->save();
        Session::flash('message', 'Tag ' . $tagName . ' has been added' );
        return redirect()->back();
    }

    public function delete ( Request $request) {
        $request->validate([
            'tag_id' => 'required'
        ]);
        $tagID = $request->input('tag_id');
        $tag = Tag::destroy( $tagID);
        Session::flash('message', 'Tag has been deleted' );
        return redirect()->back();
    }

    // Check IF Tag Name Exists //
    private function tagNameExists( $tagName ){
        $tag =  Tag::where( 'tag', '=', $tagName )->first();
        if( !is_null( $tag ) ){
             return false;
        }
        return true;
    }

    public function update (Request $request) {
        $request->validate([
            'tag_id' => 'required',
            'tag_name' => 'required'
        ]);
        $tagName = $request->input('tag_name');
        $tagID = $request->input('tag_id');
        //dd($tagID);

        if( ! $this->tagNameExists( $tagName) ){
            Session()->flash('message', 'Tag Name already exists');
            return redirect()->back();
        }       
        // Update Unit In Database        
        $tag = Tag::find( $tagID);
        $tag->tag = $tagName;
        $tag->save();
        // Flash Message on Unit Actions
        Session()->flash('message', 'Tag has been Updated!');
        return redirect()->back();
    }

    public function search( Request $request ){
        // Check Unit Input Validate   
        $request->validate([
            'tag_search' => 'required',            
        ]);
        // Unit Search In Database 
        $serachTerm = $request->input('tag_search');
        $tags = Tag::where( 
            'tag', 'LIKE', '%' . $serachTerm . '%'
        )->get();
        // Enable Search Results on Pagination in View
        if( count( $tags ) > 0 ){
            return view( 'admin.tags.tags')->with([
                'tags'     => $tags,
                'showLinks' => false,
            ]);
        }
        // Flash Message on Unit Actions
        Session::flash('message', 'Nothing Found!!!');
        return redirect()->back();
        
    }
}
