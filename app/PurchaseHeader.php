<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseDetail;

class PurchaseHeader extends Model
{
    protected $fillable = ['vendor_id', 'date', 'purchased_by', 'total_amount'];

    public function purchase_details() {
        return $this->hasMany(PurchaseDetail::class);
    }
}
