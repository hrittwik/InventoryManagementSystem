<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseHeader;

class PurchaseDetail extends Model
{
    protected $fillable = ['purchased_header_id', 'product_id', 'unit', 'quantity', 'rate', 'price'];

    public function purchase_header() {
        $this->hasOne(PurchaseHeader::class);
    }
}
