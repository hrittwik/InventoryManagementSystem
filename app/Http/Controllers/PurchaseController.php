<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Requests\StorePurchaseEntryPost;
use App\PurchaseHeader;
use App\PurchaseDetail;
use App\PurchaseAttachment;
use Illuminate\Validation\Validator;

class PurchaseController extends Controller
{
    public function index() {

        $menu = array('menu' => 'purchase', 'sub-menu' => 'purchase-index');

        return view('purchase.index', compact('menu', $menu));
    }

    public function store(Request $request) {

        $menu = array('menu' => 'purchase', 'sub-menu' => 'purchase-index');

        /*
         * To do:
         * 1. validate request for each data
         * 2. store purchase header info
         * 3. store attach document
         * 4. store purchase details
         * 5. return success or failur message
         */

        //dd($request->all());

        $this->validate($request, [
            'purchase_details.*.product_id' => 'required|numeric',
            'purchase_details.*.unit' => 'required',
            'purchase_details.*.quantity' => 'required|numeric',
            'purchase_details.*.rate' => 'required|numeric'
            ]);

        /* 
        #2
        $purchaseHeader = PurchaseHeader::create($request->all());
                  
        #3
        foreach ($request['purchase_details'] as $key => $value) {
            $purchaseHeader->purchase_details()->create($request['purchase_details'][$key]);
        }

        #4
        // upload file to server
        $file_path = $request->file('document')->store('public/purchase_attachments/'.date("Y/F"));

        // update file path for db
        $file_path = str_replace("public", "storage", $file_path);

        // insert record into db
        $purchaseAttachment = new PurchaseAttachment([
            'file_path' => $file_path
            ]);

        $purchaseHeader->purchase_attachment()->save($purchaseAttachment);*/

        // return redirect('/purchase')->with('message', $message);
    }


}
