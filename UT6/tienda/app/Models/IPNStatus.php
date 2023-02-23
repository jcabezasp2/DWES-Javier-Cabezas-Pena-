<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IPNStatus extends Model
{
    //use HasFactory;

    protected $table = 'ipn_status';

    protected $fillable = [
        'payload',
        'status',
    ];
}
