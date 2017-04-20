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

    public function update(Request $request, Unit $unit){
        $id = $request['id'];

        $this->validate($request, [
            'name' => 'required',
            'short_name' => 'required|unique:units,short_name,'.$id
        ]);

        $unit = Unit::findOrFail($request['id']);

        $unit->update([
            'name' => $request['name'],
            'short_name' => $request['short_name']
        ]);

        return $unit;
    }

    public function destroy(Request $request){
        $count = Unit::destroy($request['id']);

        if($count>0){
            return "Successfully deleted!";
        }

        return "Something went wrong";
    }

    public function CheckUniqueShortName(Request $request){

        $short_name = $request['short_name'];
        $id = $request['id'];

        $unit = Unit::where('short_name', '=', $short_name)
                      ->where('id', '!=', $id)
                      ->first();

        if(count($unit) > 0){
            return "false";
        }

        return "true";
    }

}
