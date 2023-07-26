@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')

<form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @csrf 
    @method('PATCH')
    <div class="mb-3">
        <label for="category" class="form-label d-block fw-bold">
            Category <span class="text-muted fw-normal">(Up to 3)</span>
        </label>

        @foreach($all_categories as $category)
        <div class="form-check form-check-inline">
           @if(in_array($category->id, $selected_categories))
            <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input mb-3" checked>  
           @else
            <input type="checkbox" name="category[]" id="{{ $category->name }}" value="{{ $category->id }}" class="form-check-input mb-3">  
           @endif
            
            <label for="{{$category->name}}" class="form-check-label">{{$category->name}}</label>
        </div>
        @endforeach
        <!-- Error  -->
            @error('category')
                <p class="text-danger small">{{$message}}</p>
            @enderror

        <div class="mb-3">
            <label for="description" class="form-label fw-bold">Description</label>
            <textarea name="description" id="description" placeholder="What's on your mind" rows="3" class="form-control" value=" {{ old('description', $post->description) }}" >{{old('description')}}</textarea>
            <!-- Error -->

        </div>
            @error('description')
                <p class="text-danger small">{{$message}}</p>
            @enderror
        <div class="mb-4">
            <div class="col-6">
                <label for="image" class="form-label fw-bold">Image</label>
                <img src="{{ $post->image }}" class="img-thumbnail w-100">
                <input type="file" class="form-control" name="image" id="image" aria-describedby="image-info" class="form-control mt-1">

                <div id="image-info" class="form-text">
                    The acceptable formats are jpeg, jpg, png and gif only.<br>
                    Max file size: 1048kb
                </div>
                    <!-- Error -->
                @error('image')
                    <p class="text-danger small">{{$message}}</p>
                @enderror
            </div>
        </div>
            
        <button type="submit" class="btn btn-warning px-5">Save</button>
    </div>
</form>
@endsection