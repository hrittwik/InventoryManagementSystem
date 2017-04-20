<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function unit() {

        return $this->hasOne(Unit::class);

    }
}
