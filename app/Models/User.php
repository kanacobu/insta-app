<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable ,SoftDeletes;

    const ADMIN_ROLE_ID =1;
    const USER_ROLE_ID =2;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Use this to get all the posts of the user
    public function posts()
    {
        return $this->hasMany(Post::class)->latest();
    }

    // Use this method to get all the followers of　the user
    //例題：User1がUser2をフォローしている。
    public function followers() //目的：User2のフォロワーを取得
    {
        return $this->hasMany(Follow::class, 'following_id'); //following_idは、User１がフォローしているUser（User２）を指す。
                                                            //  つまり、User1は、User2のフォロワー。 （どのユーザーがフォローされてるのかを示す外部キー）
    }

    //Use this method to get all the users that the user is following
    //例題：User1がUser2をフォローしている。
    public function following() //目的：User2をフォローしているUser（User1）を取得。
    {
        return $this->hasMany(Follow::class, 'follower_id'); //follower_idはUser2をフォローしているUser（User1）のidが入る。
    }

    public function isFollowed()
    {
        return $this->followers()->where('follower_id', Auth::user()->id)->exists();

        //Auth::user->id->the follower_id
        //Firstly, get all the followers of a user ($this->followers()), then from 
        //that lists, search for the Auth user from the follower column where('follower_id, Auth::user->id)
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    
   
}
