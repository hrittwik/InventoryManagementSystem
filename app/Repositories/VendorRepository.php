<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/14/2017
 * Time: 9:46 PM
 */

namespace App\Repositories;

use App\EntityModels\Vendor;


class VendorRepository
{

    public function all() {
        return Vendor::all();
    }

}