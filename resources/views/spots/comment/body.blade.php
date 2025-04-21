<link rel="stylesheet" href="{{ asset('css/comment.css') }}">

<!-- Comments Section -->
<div class="comment-section">
    <div class="w-full mt-2">
        <h5 class="font-normal">
        Comments({{ $spot->comments->count() }})
        </h5>
        
        {{-- add comment section --}}
        @auth
            <form action="{{ route('spots.comment.store', $spot->id) }}" method="post">
                @csrf
                <input type="hidden" name="spot_id" value="{{ $spot->id }}">
                <textarea name="content" class="comment-textarea" placeholder="your comment" required></textarea>
                <div class="flex justify-center">
                    <button type="submit" class="comment-send-button">SEND</button>
                </div>
            </form>
            @if ($errors->has('content'))
                <div class="text-danger">
                    {{ $errors->first('content') }}
                </div>
            @endif
        @else
            <p>If you want to post comments and like comments, please <a href="{{ route('login') }}">login</a>.</p>
        @endauth

        {{-- view comment section --}}
        @foreach($spot->comments as $comment)
        <div class="comment-container">
           <div class="comment-content">
                {{-- trash icon (only visible to comment owner) --}}
                @auth
                    @if(Auth::user()->id === $comment->user_id)
                        <button class="comment-trash" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $comment->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                        {{-- Include Delete Modal --}}
                        @include('spots.comment.modals.delete', ['comment' => $comment, 'spot' => $spot])
                    @endif
                @endauth

                {{-- Icon & Name & Post Date --}}
                <div class="comment-header">
                    {{-- User Icon --}}
                    <div class="comment-user-icon" id="usericon">
                        <a href="{{ route('spots.show', $comment->user->id) }}" class="spot-user-link">
                            <img src="{{ asset($comment->user->avatar) }}" alt="{{ $comment->user->name }}" class="spot-user-avatar">
                        </a>
                    </div>
                    {{-- User Name --}}
                    <div class="comment-username" id="touristname">
                        <a href="{{ route('spots.show', $comment->user->id) }}" class="spot-user-link text-decoration-none poppins-semibold text-dark fs-5">
                            {{ $comment->user->name }}
                        </a>
                    </div>
                    <div class="col-auto">
                        <p class="spot-date m-0 ms-3 text-secondary">{{ date('M d, Y', strtotime($comment->created_at)) }}</p>
                    </div>
                </div>

                {{-- comment body --}}
                <div class="comment-text" id="content">
                    <p class="text-decoration-none">
                        {{ $comment->content }}
                    </p>
                </div>

                {{-- heart button + no. likes --}}
                <div class="comment-actions d-flex justify-content-end align-items-center gap-2">
                    <div class="comment-action-item">
                        @auth
                            <button type="button"
                                class="comment-like-button border-0 bg-transparent"
                                data-comment-id="{{ $comment->id }}"
                                data-spot-id="{{ $spot->id }}"
                                data-liked="{{ $comment->isLiked() ? '1' : '0' }}">
                                <i class="fa{{ $comment->isLiked() ? 's' : 'r' }} fa-heart like-icon {{ $comment->isLiked() ? 'text-danger' : '' }}"></i>
                            </button>
                        @else
                            <i class="fa-regular fa-heart"></i>
                        @endauth
                    </div>

                    <span
                        class="count"
                        id="like-count-{{ $comment->id }}"
                        role="button"
                        data-bs-toggle="modal"
                        data-bs-target="#comment-likes-modal-{{ $comment->id }}"
                        onclick="refreshSpotCommentLikesModal({{ $comment->id }})"
                    >
                        {{ $comment->spotCommentLikes->count() }}
                    </span>

                </div>

            </div>
        </div>
        @endforeach

        @if($spot->comments->count() == 0)
            <div class="text-center mt-3">
                <p>There is no comment yet.</p>
            </div>
        @endif
    </div>
</div>
@foreach($spot->comments as $comment)
        <!-- コメント表示部分 -->
        @include('spots.comment.modals.spot-comment-likes', ['comment' => $comment])
@endforeach
{{-- view images --}}
<script src="{{ asset('js/spot/view/comment.js') }}"></script>

