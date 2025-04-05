<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $appends = ['text'];
    
    public function getTextAttribute()
    {
        return $this->name;
    }
}
