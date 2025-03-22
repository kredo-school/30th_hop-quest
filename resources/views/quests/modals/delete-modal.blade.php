<div class="modal fade" id="delete-post">
    <div class="modal-dialog">
        <div class="modal-content border-red">
            <div class="modal-header">
                <h3 class="h3"> <i class="fa-solid fa-trash"></i> Delete Post</h3>
            </div>
            <div class="modal-body">
                <p> Are you sure you want to delete this post?</p>
                {{-- <img src="{{ $post->image }}" alt="" class="img-lg"> --}}
                <p class="text-center">POST TITLE</p>
            </div>
            <div class="modal-footer border-0">
                <form action="" method="">
                    {{-- {{ route('admin.posts.hide', $post->id) }} --}}
                    @csrf
                    @method('DELETE')
                    <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-red">Cancel</button>
                    <button type="submit" class="btn btn-sm btn-red">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>