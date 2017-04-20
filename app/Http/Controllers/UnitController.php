<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    //
    public function index(){

        $menu = "unit";
        return view('unit.index', compact('menu'));
    }

    public function GetAll(){

        return Unit::all();
    }

}
