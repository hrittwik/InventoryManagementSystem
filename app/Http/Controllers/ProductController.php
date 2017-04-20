<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {

        $menu = "product";

        return view('product.index')->with('menu', $menu);
    }

    public function GetAll() {

        return Product::all();

    }

    public function store(Request $request, Product $product) {

        $this->validate($request, [
            'name' => 'required',
            'short_name' => 'required|unique:products|max:10',
            'unit_id' => 'required',
        ]);
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
