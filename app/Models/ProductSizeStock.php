<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductSizeStock extends Model
{
    public function size(){
        return $this->belongsTo(Size::class);
    }
}
