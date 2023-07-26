@extends('layouts.app')

@section('title', 'Admin Categories')

@section('content')


<form action="{{ route('admin.store') }}" method="post">
    @csrf
    <div class="row mb-3">
        <div class="col">
            <input type="text" name="name" id="name" class="form-control border-primary ">
        </div>
        <div class="col">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-plus"></i>Add</button>
        </div>
    </div>
</form>

<table class="table table-hover align-middle bg-white border text-secondary w-75">
    <thead class="table-warning text-secondary small">
        <tr>
            <th>#</th>
            <th>NAME</th>
            <th>COUNT</th>
            <th>LAST UPDATE</th>
            <th></th>
            <th></th>
            
        </tr>
        <tbody>
            <tr>
            @forelse($all_categories as $category)

                <td>{{ $category->id }}</td>
                <td>{{ Str::title($category->name) }}</td>
                <td>{{ $category->CategoryPost->count() }}</td>
                <td>{{ $category->updated_at }}</td>
                <td><button data-bs-toggle="modal" data-bs-target="#update-category-{{ $category->id }}" class="btn btn-outline-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></button></td>
                <td><button data-bs-toggle="modal" data-bs-target="#delete-category-{{ $category->id }}" class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash-can"></i></button></td>
            </tr>
            @include('admin.categories.modals.edit')
            @include('admin.categories.modals.delete')
            @empty
                <tr>
                    <td colspan="6" class="lead text-muted text-center">No posts found</td>
                </tr>
            @endforelse
        </tbody>
        
    </thead>

    
</table>



@endsection