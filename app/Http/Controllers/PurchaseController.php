<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\View\View;
use function MongoDB\BSON\toJSON;

class PurchaseController extends Controller
{
    public function index() {

        $menu = array('menu' => 'purchase', 'sub-menu' => 'purchase-index');

        return view('purchase.index', compact('menu', $menu));
    }

    public function store(Request $request) {

        /*
         * To do:
         * 1. validate request
         * 2. store purchase header info
         * 3. store attach document
         * 4. store purchase details */

        //dd(date("Y/F"));
        dd($request->all());
        return $request->file('document')->store('purchase_attachments/'.date("Y/F"));
    }
}
