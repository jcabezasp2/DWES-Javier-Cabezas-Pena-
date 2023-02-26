<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;

class Product extends Model
{
    use HasFactory;

    public function invoice(){
        return $this->belongsToMany(Invoice::class);
    }
}
