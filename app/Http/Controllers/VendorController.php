<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vendor;

class VendorController extends Controller
{
     public function index() {
        $vendors = Vendor::all();
        $menu = "vendor";

        return view('vendor.index', compact('vendors'))->with('menu', $menu);
    }
}
