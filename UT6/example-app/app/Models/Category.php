<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
            'name',
    ];

    public function projects(){
        return $this->hasMany(\App\Models\Project::class);

    }
}
