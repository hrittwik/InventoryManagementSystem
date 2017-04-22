<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use PhpParser\Builder\Class_;
use Illuminate\Http\Request;
use App\Unit;
use App\Http\Requests\StoreUnitPost;

class UnitController extends Controller
{
    //
    public function index() {

        $menu = array('menu' => 'unit');

        return view('unit.index', compact('menu'));
    }

    public function GetAll() {

        return Unit::all();
    }

    public function store(StoreUnitPost $request)
    {

        return Unit::create($request->all());
    }

    public function update(StoreUnitPost $request, Unit $unit) {

        
        $unit = Unit::findOrFail($request['id']);

        $unit->update([
            'name' => $request['name'],
            'short_name' => $request['short_name']
        ]);

        return $unit;
    }

    public function destroy(Request $request) {
        
        $count = Unit::destroy($request['id']);

        if($count>0){
            return "Successfully deleted!";
        }

        return "Something went wrong";
    }

    public function CheckUniqueShortName(Request $request) {

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
