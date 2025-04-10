<div class="modal fade" id="comment-likes-modal-{{ $comment->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-green">
            <div class="modal-header border-0">
                <h4 class="color-green poppins-semibold text-center w-100">Liked by...</h4>
            </div>
            <div class="modal-body px-4">
                @forelse ($comment->QuestCommentlikes as $like)
                    @php 
                        $user = $like->user; 
                    @endphp
                
                    <div class="row align-items-center mb-3">
                        <div class="col-2 d-flex justify-content-center">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="" class="rounded-circle avatar-sm">
                            @else
                                <i class="fa-solid fa-circle-user text-secondary icon-mmd text-center"></i>
                            @endif
                        </div>
                        <div class="col-7 text-start">
                            <a href="" class="text-decoration-none text-dark fw-bold">
                                {{-- {{ route('profile.show', $user->id) }} --}}
                                {{ $user->name }}
                            </a>
                        </div>
                        <div class="col-3 text-end">
                            @if($user->id !== Auth::id())
                                <form class="follow-toggle-form" data-user-id="{{ $user->id }}">
                                    @csrf
                                    @php
                                        $isFollowing = Auth::user()->follows->contains('followed_id', $user->id);
                                    @endphp

                                    @if($user->id !== Auth::id())
                                        <button type="button" class="btn px-3 py-0 {{ $isFollowing ? 'btn-following' : 'btn-follow' }}">
                                            {{ $isFollowing ? 'Following' : 'Follow' }}
                                        </button>
                                    @endif

                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No likes yet.</p>
                @endforelse
                
            </div>
        </div>
    </div>
</div>
