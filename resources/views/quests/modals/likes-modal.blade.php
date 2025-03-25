<div class="modal fade" id="likes-modal">
    <div class="modal-dialog">
        <div class="modal-content border-green">
            <div class="modal-header border-0">
                <button data-bs-dismiss="modal" class="btn btn-sm ms-auto text-green fw-bold">X</button>
            </div>
            <div class="modal-body px-5">
                <div class="container-fluid w-75 mx-auto">
                    {{-- @foreach($post->likes as $like) --}}
                        <div class="row align-items-center mb-3">
                            <div class="col-2-auto">
                                {{-- @if($like->user->avatar) --}}
                                    <img src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg') }}" alt="" class="rounded-circle avatar-sm">
                                {{-- @else  --}}
                                    {{-- <i class="fa-solid fa-circle-user text-secondary icon-sm"></i> --}}
                                {{-- @endif  --}}
                            </div>
                            <div class="col-7">
                                <a href="" class="text-decoration-none text-dark fw-bold">
                                    {{-- route('profile.show', $like->user_id) --}}
                                    {{-- {{ $like->user->name }} --}}
                                    Mickey Mouse
                                </a>
                            </div>
                            <div class="col-3 text-end">
                                {{-- @if($like->user->id != Auth::user()->id) --}}
                                    {{-- @if($like->user->isFollowed()) --}}
                                    {{-- unfollow --}}
                                        <form action="" method="post">
                                            {{-- route('follow.delete', $like->user->id)  --}}
                                            @csrf    
                                            @method('DELETE')
                                            <button type="submit" class="btn p-0 bg-transparent text-secondary">Unfollow</button>
                                        </form>
                                    {{-- @else --}}
                                    {{-- follow --}}
                                        <form action="" method="post">
                                            {{-- route('follow.store', $like->user->id)  --}}
                                            @csrf
                                            <button type="submit" class="btn p-0 bg-transparent text-primary">Follow</button>
                                        </form>
                                    {{-- @endif --}}
                                {{-- @endif --}}
                            </div>
                        </div>
                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>
</div>