<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $units = Role::paginate(20);
        return view('admin.units.units')->with(['units' => $units]);
    }
}
