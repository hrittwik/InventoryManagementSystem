<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Builder\Class_;
use App\Repositories\VendorRepository;

class VendorController extends Controller
{
    protected $vendorRepository;

    public function __construct()
    {
        $this->vendorRepository = new VendorRepository();
    }

    public function index() {

        $menu = "vendor";

        return view('vendor.index', compact('vendors'))->with('menu', $menu);
    }

    public function getAll() {

        return $this->vendorRepository->all();
    }
}
