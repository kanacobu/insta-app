@extends('layouts.app')

@section('title', 'Admin Posts')

@section('content')
<table class="table table-hover align-middle bg-white border text-secondary">
    <thead class="table-primary text-secondary small">
        <tr>
            <th></th>
            <th></th>
            <th>Category</th>
            <th>Author</th>
            <th>Created at</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>

    <tbody>
        @forelse($all_posts as $post)
            <tr>
                <td class="text-end">{{ $post->id }}</td>
                <td>
                    <a href="{{ route('post.show', $post->id) }}"><img src="{{ $post->image }}" alt="post id {{ $post->id }}" class="image-lg mx-auto d-block "></a>
             
                </td>
                <td>
                    @foreach($post->categoryPost as $category_post)
                        <span class=" badge bg-secondary bg-opacity-50">{{ $category_post->category->name }}</span>
                    @endforeach
                </td>

                <td><a href="{{ route('profile.show',$post->user->id ) }}" class="text-dark text-decoration-none">{{ $post->user->name }}</a></td>
                <td>{{ $post->created_at }}</td>

                <td>
                    @if($post->trashed())
                        <i class="fa-solid fa-circle-minus text-secondary"></i></i>&nbsp; Hidden
                    @else 
                        <i class="fa-solid fa-circle text-primary"></i>&nbsp; Visible
                    @endif
                    
                </td>
                <td>
                    <div class="dropdown">

                        <button class="btn btn-sm" data-bs-toggle="dropdown"><i class="fa-solid fa-ellipsis"></i></button>

                        <div class="dropdown-menu">
                        @if($post->trashed())
                            <button class="dropdown-item text-secondary" data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                                <i class="fa-solid fa-eye text-secondary"></i>
                                Unhide Post {{ $post->id}}
                            </button>

                        @else
                            <button class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#hide-post-{{ $post->id }}">
                                <i class="fa-solid fa-eye-slash text-danger"></i> Hide Post {{ $post->id}}
                            </button>
                        @endif
                        </div>
                    </div>
                    <!-- modal -->
                    @include('admin.posts.modal.status')
                </td>
            </tr>
            @empty 
                <tr>
                    <td colspan="7" class="lead text-muted text-center">No posts found</td>
                </tr>
            @endforelse
    </tbody>
</table>


@endsection