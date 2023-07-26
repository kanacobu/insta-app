<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function show($id)
    {
        $user=$this->user->findOrFail($id);

        return view('users.profile.show')->with('user', $user);
    }

    public function edit()
    {
        $user=$this->user->findOrFail(Auth::user()->id);
        return view('users.profile.edit')->with('user', $user);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required|min:1|max:10',
            'email'=>'required',
            'introduction'=>'required|min:1|max:100',
            'avatar'=>'mimes:jpg,jpeg,png,gif|max:1048'
        ]);

        $user=$this->user->findOrFail(Auth::user()->id);
        $user->name=$request->name;
        $user->email=$request->email;
        $user->introduction=$request->introduction;

        if($request->avatar){
            $user->avatar='data:avatar/'. $request->avatar->extension(). ';base64,' . base64_encode(file_get_contents($request->avatar));   
        }

        $user->save();


        return redirect()->route('profile.show', Auth::user()->id);
       
    }

    public function followers($id)
    {
        $user=$this->user->findOrFail($id); //the $id here is the id of the user we want to view/follow
        return view('users.profile.followers')->with('user', $user);
    }

    public function following($id)
    {
        $user=$this->user->findOrFail($id);
        return view('users.profile.following')->with('user', $user);
    }
    
    
}
