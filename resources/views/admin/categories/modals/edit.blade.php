<div class="modal fade" id="update-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-warning">
            <div class="modal-header border-warning">
                <h3><i class="fa-regular fa-pen-to-square"></i> Edit Category</h3>
            </div>
            <form action="{{ route('admin.categories.update',$category->id) }}" method="post">
                @csrf 
                @method('PATCH')
                <div class="modal-body border-warning">
                    <input type="text" name="name" id="category" class="form-control" value=" {{ old('name',$category->name ) }}">
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-warning btn-sm" data-bs-toggle="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning btn-sm">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>