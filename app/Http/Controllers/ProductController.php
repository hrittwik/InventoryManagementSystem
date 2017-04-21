<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductPost;

class ProductController extends Controller
{
    public function index() {

        $menu = "product";

        return view('product.index', compact('menu', $menu));
    }

    public function GetAll() {

        return Product::with('unit')->get();
        
        /*$product = Product::findOrFail(1);

        $product->update([
            'name' => 'test',
            'short_name' => 'test',
            'unit_id' => '1',
            'description' => 'test'
        ]);

        return $product->with('unit')->get();*/

    }

    public function store(StoreProductPost $request) {

        return Product::create($request->all());
    }

    public function update(StoreProductPost $request, Product $product) {

        $product = Product::findOrFail($request['id']);

        $product->update([
            'name' => $request['name'],
            'short_name' => $request['short_name'],
            'unit_id' => $request['unit_id'],
            'description' => $request['description']
        ]);

        return $product->with('unit')->first();
    }

    public function destroy(Request $request) {

        $count = Product::destroy($request['id']);

        if($count > 0) {
            return "Successfully Deleted";
        }

        return "Something went wrong!";

    }

    public function CheckUniqueShortName(Request $request) {
        $short_name = $request['short_name'];
        $id = $request['id'];

        $product = Product::where('short_name', '=', $short_name)
            ->where('id', '!=', $id)
            ->first();

        if(count($product) > 0) {
            return "false";
        }

        return "true";
    }
}
