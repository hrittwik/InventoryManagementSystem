<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PurchaseHeader;

class PurchaseAttachment extends Model
{
	protected $fillable = ['file_path'];
	
    public function purchase_header() {
    	return $this->belongsTo(PurchaseHeader::class);
    }
}
