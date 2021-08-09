<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Unitcontroller extends Controller {
    // Fetch Unit From Database //
    public function index(){
        $units = Unit::paginate(env("PAGINATION_COUNT"));
        return view('admin.units.units')->with([
            'units' => $units,
            'showLinks' => true, 
        ]);
    }
    // Check IF Unit Name Exists //
    private function unitNameExists( $unitName ){
        $unit =  Unit::where( 'unit_name', '=', $unitName )->first();
        if( !is_null( $unit ) ){
            Session::flash('message', 'Unit Name ('.$unitName.') Already Exists' );
            return false;
        }
        return true;
    }
    // Check IF Unit Code Exists //
    private function unitCodeExists( $unitCode ){
        $unit =  Unit::where( 'unit_code', '=', $unitCode )->first();
        if(  !is_null( $unit ) ){
            Session::flash('message', 'Unit Code ('.$unitCode.') Already Exists' );
            return false;
        }
        return true;
    }
    // Add New Unit //
    public function store( Request $request ){
        // Check Unit Input Validate  
        $request->validate([
            'unit_name' => 'required',
            'unit_code' => 'required'
        ]);

        // Use The Private Function To Check if Unit Exists Before Add New Unit
        $unitName = $request->input('unit_name');
        $unitCode = $request->input('unit_code');
        if( !$this->unitNameExists( $unitName) ){
            return redirect()->back();
        }
        if( !$this->unitCodeExists( $unitCode ) ){
            return redirect()->back();
        }  
        // Save The New Unit In Database
        $unit = new Unit();
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        // Flash Message on Unit Actions 
        Session()->flash('message', 'Unit '. $unit->unit_name. ' has been added Successfully!');
        return redirect()->back();
    }
    // Update Unit //
    public function update( Request $request ){
        // Check Unit Input Validate  
        $request->validate([
            'unit_code'   => 'required',
            'unit_id'     => 'required',
            'unit_name'   => 'required'
        ]);
        // Use The Private Function To Check if Unit Exists Before Add New Unit
        $unitName = $request->input('unit_name');
        $unitCode = $request->input('unit_code');
        if( !$this->unitNameExists( $unitName) ){
            return redirect()->back();
        }
        if( !$this->unitCodeExists( $unitCode ) ){
            return redirect()->back();
        }        
        // Update Unit In Database
        $unitID = intval( $request->input('unit_id') );
        $unit = Unit::find( $unitID);
        $unit->unit_name = $request->input('unit_name');
        $unit->unit_code = $request->input('unit_code');
        $unit->save();
        // Flash Message on Unit Actions
        Session()->flash('message', 'Unit ' . $unit->unit_name . ' has been Updated!');
        return redirect()->back();
    }
    // Unit Search //
    public function search( Request $request ){
        // Check Unit Input Validate   
        $request->validate([
            'unit_search' => 'required',            
        ]);
        // Unit Search In Database 
        $serachTerm = $request->input('unit_search');
        $units = Unit::where( 
            'unit_name', 'LIKE', '%' . $serachTerm . '%'
        )->orWhere(
            'unit_code', 'LIKE', '%' . $serachTerm . '%'
        )->get();
        // Enable Search Results on Pagination in View
        if( count( $units ) > 0 ){
            return view( 'admin.units.units')->with([
                'units'     => $units,
                'showLinks' => false,
            ]);
        }
        // Flash Message on Unit Actions
        Session::flash('message', 'Nothing Found!!!');
        return redirect()->back();
    }
    // Delete Unit //
    public function delete( Request $request ){
        // Check The Unit Parameter 
        if( is_null( $request->input('delete_unit_id') ) || empty( $request->input('delete_unit_id') ) ){
            Session()->flash('message', 'Unit id is required!');
            return redirect()->back();
        } 
        // Delete The Unit From Database
        $id = $request->input('delete_unit_id');
        Unit::destroy($id);
        // Flash Message on Unit Actions
        Session()->flash('message', 'Unit has been deleted!');
        return redirect()->back();
    }
}
