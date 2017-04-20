<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\Response;
use PhpParser\Builder\Class_;
use Illuminate\Http\Request;
use App\Vendor;

class VendorController extends Controller
{
    public function index() {

        $menu = "vendor";

        return view('vendor.index')->with('menu', $menu);
    }

    public function GetAll() {

        return Vendor::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:vendors',
            'contact' => 'required'
        ]);

        return Vendor::create($request->all());
    }

    public function update(Request $request, Vendor $vendor)
    {
        $id = $request['id'];

        $this->validate($request, [
            'name' => 'required|unique:vendors,name,'.$id,
            'contact' => 'required'
        ]);

        $vendor = Vendor::findOrFail($request['id']);

        $vendor->update([
            'name' => $request['name'],
            'contact' => $request['contact'],
            'address' => $request['address']
        ]);

        return $vendor;
    }

    public function destroy(Request $request)
    {
        $count = Vendor::destroy($request['id']);

        if($count > 0) {
            return "Successfully Deleted";
        }

        return "Something went wrong!";
    }

    public function CheckUniqueName(Request $request){

        $name = $request['name'];
        $id = $request['id'];

        $vendor = Vendor::where('name', '=', $name)
                        ->where('id', '!=', $id)
                        ->first();

        if(count($vendor) > 0) {
            return "false";
        }

        return "true";
    }
}
