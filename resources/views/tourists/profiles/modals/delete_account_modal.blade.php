<div class="modal fade" id="delete-account-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger shadow">
            <div class="modal-body px-5 py-4">
                <h5 class="fw-bold text-dark mb-3 text-start my-4">Delete your account?</h5>
                <p class="text-dark text-start my-5">Are you sure want to delete your account?</p>

                <form action="{{ route('myprofile.destroy') }}" method="POST" class="mt-5">
                    @csrf
                    @method('DELETE')


                    <div class="d-flex justify-content-end gap-3 my-5">
                        <button type="button" class="btn btn-outline-danger px-4"
                            data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" class="btn btn-danger px-4">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
