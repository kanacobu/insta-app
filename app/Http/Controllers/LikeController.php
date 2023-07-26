<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Like;
use App\Models\Post;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    private $like;
    private $user;
    private $follow;
    private $post;

    public function __construct(Like $like ,User $user, Follow $follow, Post $post)
    {
        $this->like=$like;
        $this->user=$user;
        $this->user=$follow;
        $this->post=$post;
    }

    public function store($post_id)
    {
        $this->like->user_id=Auth::user()->id;
        $this->like->post_id =$post_id;
        $this->like->save();

        return redirect()->back();
    }

    public function destroy($post_id)
    {
        $this->like
        ->where('user_id',Auth::user()->id)
        ->where('post_id',$post_id)
        ->delete();

        return redirect()->back();
    }

    public function showlikeusers($id)
    {

        // 間違え：$like_user =$this->like->groupBy('user_id')->get('user_id');

        $like_user = $this->like->where('post_id', $id)->get();
        $post = $this->post->findOrFail($id);
        
        return view('users.posts.showusers')->with('like_user',$like_user)->with('post',$post);
        
    }

    public function displaylikeImages()
    {
        $user_id = Auth::user()->id; //ログインユーザーのidを取得

        $like_users = $this->like->where('user_id', $user_id)->get();

        $post_id = $like_users->pluck('post_id');

        $like_images = $this->post->whereIn('id', $post_id)->get();

        return view('displaylike')->with('like_images', $like_images);
    }
}
