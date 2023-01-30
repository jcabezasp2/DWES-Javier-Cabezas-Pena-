<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Role extends Model
{
    use HasFactory ;

    protected $fillable = [
        'name',
        'guard_name',
        'permissions',
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
