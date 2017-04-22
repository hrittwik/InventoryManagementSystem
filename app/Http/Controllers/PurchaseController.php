<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index() {

        $menu = array('menu' => 'purchase', 'sub-menu' => 'index');
        //$menu = "purchase";

        return view('purchase.index', compact('menu', $menu));
    }
}
