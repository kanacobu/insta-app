<div class="modal fade" id="delete-category-{{ $category->id }}">
    <div class="modal-dialog">
        <div class="modal-content border-danger">
            <div class="modal-header border-danger">
                <h3 class="text-danger" ><i class="fa-solid fa-trash-can"></i> Delete Category</h3>
            </div>
            <form action="{{ route('admin.categories.destroy',$category->id) }}" method="post">
                @csrf 
                @method('DELETE')
                <div class="modal-body">
                    Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span>category?<br>
                    This action will affect all the posts under this category. Posts without a category will fall under Uncategorized.
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-danger btn-sm" data-bs-toggle="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>