<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Invoice extends Model
{
    //use HasFactory;

    protected $fillable = ['user_id', 'price', 'paid'];

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}


