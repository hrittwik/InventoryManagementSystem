<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseDetail;
use App\PurchaseAttachment;
use App\Vendor;

class PurchaseHeader extends Model
{
    protected $fillable = ['vendor_id', 'date', 'purchased_by', 'total_amount'];

    public function purchase_details() {
        return $this->hasMany(PurchaseDetail::class);
    }

    public function purchase_attachment() {
    	return $this->hasOne(PurchaseAttachment::class);
    }

    public function vendor () {
    	return $this->belongsTo(Vendor::class);
    }
}
