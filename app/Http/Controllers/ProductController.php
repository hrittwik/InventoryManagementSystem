<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {

        $menu = "product";

        return view('product.index')->with('menu', $menu);
    }
}
