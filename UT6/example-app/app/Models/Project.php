<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image' ,'user_id', 'category_id'];

    protected static function boot(){

        parent::boot();
        if(!app()->runningInConsole()){
            self::creating(function(Project $project){
                $project->user_id = auth()->id();
            });
        }
    }


    public function user(){
        return $this->belongsTo(\App\Models\User::class);
    }

    public function category(){
        return $this->belongsTo(\App\Models\Category::class);
    }
}
