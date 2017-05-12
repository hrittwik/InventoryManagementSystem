<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseHeader;

class PurchaseDetail extends Model
{
    protected $fillable = ['product_id', 'unit', 'quantity', 'rate', 'price'];

    public function purchase_header() {
        return $this->belongsTo(PurchaseHeader::class);
    }
}
