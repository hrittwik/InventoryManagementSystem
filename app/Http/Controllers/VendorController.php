<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Builder\Class_;
use App\Vendor;

class VendorController extends Controller
{
    public function index() {

        $menu = "vendor";

        return view('vendor.index', compact('vendors'))->with('menu', $menu);
    }

    public function getAll() {

        return Vendor::all();
    }
}
