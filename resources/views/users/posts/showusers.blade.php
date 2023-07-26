@extends('layouts.app')

@section('title','Show Likeeduser')

@section('content')
    <div class="row justify-content-center">
        <div class="card w-50 border-0  text-center bg-dark text-white">
            <div class="card-header border-white">
               
                <h1>Like!  {{ $post->likes->count() }}</h1>
            </div>
            <div class="card-body">
            @foreach($like_user as $user)
                <div class="row">
                   
                        <div class="col text-start mb-3">
                            @if($user->user->avatar)
                                <img src="{{ $user->user->avatar}}" alt="{{ $user->user->name}}" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                            {{$user->user->name}}
                        </div>
                        <div class="col text-end">
                            @if($user->user->id != Auth::user()->id)
                                @if($user->user->isFollowed())
                                    <form action="{{ route('follow.destroy', $user->user->id) }}" method="post">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="border-0 bg-transparent p-0 text-secondary btn-sm">Following</button>
                                    </form>       
                                @else
                                <form action="{{ route('follow.store', $user->user->id) }}" method="post">
                                    @csrf 
                                    
                                    <button type="submit" class="border-0 bg-transparent p-0 text-primary btn-sm">Follow</button>
                                </form>
                                @endif
                            @endif       
                        </div>
                </div> 
                    @endforeach
            </div>
        </div>
    </div>
@endsection