<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseHeader;

class Vendor extends Model
{
    protected $fillable = ['name', 'contact', 'address'];

    public function purchase_headers() {
    	return $this->hasMany(PurchaseHeader::class);
    }
}
