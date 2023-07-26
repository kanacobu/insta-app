@extends('layouts.app')

@section('title','Display Images')

@section('content')
    <div class="row">
        @forelse($like_images as $like_image)
            <div class="col-4">
               <a href="{{ route('post.show', $like_image->id) }}"><img src="{{ $like_image->image }}"  class="grid-img mt-4"></a>
            </div>
           
            @empty
            <div class="col text-muted text-center">
                <i class="fa-brands fa-instagram" id="like_posts"></i>
                <h2 class="mt-2">There are no posts that you liked</h2>
            </div>
            
        @endforelse
    </div>
@endsection