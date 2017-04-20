<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use PhpParser\Builder\Class_;
use Illuminate\Http\Request;
use App\Unit;

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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'short_name' => 'required|unique:units'
        ]);

        return Unit::create($request->all());
    }

}
