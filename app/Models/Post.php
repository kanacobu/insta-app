<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory,SoftDeletes;

    

    // A post belongs to a user
    // User this method to get owner of the post

    public function user()
    {
        return $this->belongsTo(User::class)->withTrashed();
    }

    // to get a categories under a post
    public function CategoryPost()
     {
        return $this->hasMany(CategoryPost::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //Return true if the Auth 
    public function isLiked()
    {
        return $this->likes()->where('user_id', Auth::user()->id)->exists();
    }
   
    
}
