<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;



class PostController extends Controller
{
    private $post;
    private $category;

    public function __construct(Post $post, Category $category)
    {
        $this->post = $post;
        $this->category = $category;
    }

    public function create()
    {
        // retrieve all the categories
        // use the categories in create.blade.php
        $all_categories = $this->category->all();
        return view('users.posts.create')->with('all_categories', $all_categories);
    }

    public function store(Request $request)
    {
        // 1 validate
        $request->validate([
            'category'=>'required|array|between:1,3',
            'description'=>'required|min:1|max:50',
            'image'=>'required|mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        // 2 received all data from form
        $this->post->user_id=Auth::user()->id;
        $this->post->description=$request->description;
        $this->post->image= 'data:image/'. $request->image->extension() . ';base64,'. base64_encode(file_get_contents($request->image));
         $this->post->save(); //insert into posts(user_id, image,description)values(Auth::user()->id, '$image',$request->description)

        // 3 save categories
        foreach($request->category as $category_id){
            $category_post[] = ['category_id'=>$category_id];

            // 1 - Food, 2 -Travel,...
            // $category_post[1,2]
        }
        $this->post->categoryPost()->createMany($category_post); //insert category_post_table in the database
                                    // createMany()-->requires that we have a ['key' =>'value' pair]  of data
        // given/data
        // $this->post->id(1)
        // $request->category[1,2,3]

        // After the $this->post->categoryPost()
        // $category_post = [
        // ['post_id' =>1',category_id' =>1],
        // ['post_id' =>1 ,'category_id' =>2 ],
        // ['post_id' =>1 ,'category_id' =>3 ],
        
        // ];

        // 4 back to homepage
        return redirect()->route('index'); 
    }
    
    public function show($id)
    {
        $post = $this->post->findOrFail($id);
        return view('users.posts.show')->with('post', $post);
    }

    public function edit($id)
    {
        $post = $this->post->findOrFail($id);

        if(Auth::user()->id != $post->user->id){
            return redirect()->route('index');
        }
        // retrieve all the categories
       $all_categories = $this->category->all();

    //    get all the categories of this post and save it in an array
    $selected_categories = []; //this is an empty array for now

    foreach($post->categoryPost as $category_post){
        $selected_categories[] = $category_post->category_id;
    }
   
    return view('users.posts.edit')
    ->with('post',$post)
    ->with('all_categories', $all_categories)
    ->with('selected_categories', $selected_categories); //after the loop the array will have all the categories under this post
    }

    public function update(Request $request,$id) 
    {
        $request->validate([
            'category'=>'required|array|between:1,3',
            'description'=>'required|min:1|max:1000',
            'image'=>'mimes:jpg,png,jpeg,gif|max:1048'
        ]);

        //update the Post
        $post=$this->post->findOrFail($id);
        $post->description=$request->description;

        //if there is a new image...
        if($request->image){
            $post->image='data:image/'. $request->image->extension(). ';base64,' . base64_encode(file_get_contents($request->image));   
        }

        $post->save();

        //3. delete all the records from category_post related to this post
        $post->categoryPost()->delete();
        //use the relationship Post::categoryPost() to select the records related to a post
        //Equivalent:DELETE FROM category_post WHERE post_id = $id;

        //4. Save the new categories to category_posts table
        foreach($request->category as $category_id){
            $category_post[] = ['category_id' =>$category_id];
        }

        $post->categoryPost()->createMany($category_post);

        //5. Redirect to Show Post Page (to confirm the update)
        return redirect()->route('post.show', $id);
    }


    public function destroy($id)
    {
        $this->post->find($id)->forceDelete();
        
        return redirect()->route('index');
    }
}
