<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Product extends Model
{
    use HasFactory;
    protected $appends = ['product_image'];
    //Conts
    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    //Methods
    public function getProductImageAttribute(){
        return asset('storage/product_images/'.$this->image);
    }

    //Relations
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function brand(){
        return $this->belongsTo(Brand::class);
    }

    public function product_stocks(){
        return $this->hasMany(ProductSizeStock::class);
    }
}
