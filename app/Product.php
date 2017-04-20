<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'short_name', 'unit_id', 'description'];

    public function unit() {

        return $this->hasOne(Unit::class);

    }
}
