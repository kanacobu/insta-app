<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\CategoriesController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::group(['middleware'=>'auth'],function(){
    Route::get('/',[HomeController::class, 'index'])->name('index'); //homepage
    Route::get('/people',[HomeController::class, 'search'])->name('search');

    // post
    Route::get('/post/create',[PostController::class, 'create'])->name('post.create');
    Route::post('/post/store',[PostController::class, 'store'])->name('post.store');
    Route::get('/post/show/{id}',[PostController::class, 'show'])->name('post.show');
    Route::get('/post/{id}/edit',[PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{id}/update',[PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}/destroy',[PostController::class, 'destroy'])->name('post.destroy');

    // comment
    Route::post('/comment/{post_id}/store',[CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}/destroy',[CommentController::class, 'destroy'])->name('comment.destroy');

    // Profile
    Route::get('/profile/{id}/show',[ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit',[ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update',[ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}/followers',[ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{id}/following',[ProfileController::class, 'following'])->name('profile.following');

    // like
    Route::post('/like/{post_id}/store',[LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{post_id}/destroy',[LikeController::class, 'destroy'])->name('like.destroy');
    Route::get('/like/{post_id}/showlikeusers',[LikeController::class, 'showlikeusers'])->name('like.showlikeusers');
    Route::get('/like/{post_id}/displaylikeimages',[LikeController::class, 'displaylikeimages'])->name('like.displaylikeimages');
    

    // Follow
    Route::post('/follow/{user_id}/store',[FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/store',[FollowController::class, 'destroy'])->name('follow.destroy');

    Route::group(['prefix' => 'admin', 'as' => 'admin.','middleware'=>'admin'], function(){
        Route::get('/users', [UsersController::class, 'index'])->name('users'); //localhost/admin.users
        Route::delete('/users/{id}/deactivate', [UsersController::class, 'deactivate'])->name('users.deactivate');
        Route::patch('/users/{id}/activate', [UsersController::class, 'activate'])->name('users.activate');

        Route::get('/posts', [PostsController::class, 'index'])->name('posts'); //localhost/admin.posts
        Route::delete('/pots/{id}/hide', [PostsController::class, 'hide'])->name('hide'); 
        Route::patch('/posts/{id}/visible', [PostsController::class, 'visible'])->name('posts.visible'); 

        Route::get('/categories', [CategoriesController::class, 'index'])->name('categories'); 
        Route::post('/store', [CategoriesController::class, 'store'])->name('store'); 
        Route::patch('/categories/{id}/update', [CategoriesController::class, 'update'])->name('categories.update'); 
        Route::delete('/categories/{id}/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy'); 

        
    });
});
