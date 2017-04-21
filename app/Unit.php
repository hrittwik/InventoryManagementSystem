<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = ['name', 'short_name'];

    public function product() {

        return $this->hasOne(Product::class);

    }
}
