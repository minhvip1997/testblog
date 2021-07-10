<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
    protected $table = "posts";

    public function comments()
    {
        return $this->hasMany('App\Models\Comments','on_post','id');    
    }

    public function author()
    {
        return $this->belongsTo('App\Models\User','author_id','id');
    }
}
