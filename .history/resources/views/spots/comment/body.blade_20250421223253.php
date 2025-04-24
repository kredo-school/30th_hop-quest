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
        @foreach ($spot->comments as $comment)
            <div class="comment-container">
                <div class="comment-content">
                    {{-- trash icon (only visible to comment owner) --}}
                    @auth
                        @if (Auth::user()->id === $comment->user_id)
                            <button class="comment-trash" data-bs-toggle="modal"
                                data-bs-target="#deleteModal{{ $comment->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            {{-- Include Delete Modal --}}
                            @include('spots.comment.modals.delete', [
                                'comment' => $comment,
                                'spot' => $spot,
                            ])
                        @endif
                    @endauth

                    {{-- Icon & Name & Post Date --}}
                    <div class="comment-header">
                        {{-- User Icon --}}
                        <div class="comment-user-icon" id="usericon">
                            <a href="{{ route('spot.show', $comment->user->id) }}" class="spot-user-link">
                                <img src="{{ asset($comment->user->avatar) }}" alt="{{ $comment->user->name }}"
                                    class="spot-user-avatar">
                            </a>
                        </div>
                        {{-- User Name --}}
                        <div class="comment-username" id="touristname">
                            <a href="{{ route('spot.show', $comment->user->id) }}" class="spot-user-link">
                                {{ $comment->user->name }}
                            </a>
                        </div>
                        <div class="col-auto">
                            <p class="spot-date">{{ date('M d, Y', strtotime($comment->created_at)) }}</p>
                        </div>
                    </div>

                    {{-- comment body --}}
                    <div class="comment-text" id="content">
                        <p class="text-decoration-none">
                            {{ $comment->content }}
                        </p>
                    </div>

                    {{-- heart button + no. likes --}}
                    <div class="comment-actions">
                        <div class="comment-action-item">
                            @auth
                                @if ($comment->likes->contains('user_id', Auth::user()->id))
                                    <form
                                        action="{{ route('spot.comment.unlike', ['spot_id' => $spot->id, 'comment_id' => $comment->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="comment-like-button">
                                            <i class="fa-solid fa-heart"></i>
                                        </button>
                                    </form>
                                @else
                                    <form
                                        action="{{ route('spot.comment.like', ['spot_id' => $spot->id, 'comment_id' => $comment->id]) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="comment-like-button">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </form>
                                @endif
                            @else
                                <i class="fa-regular fa-heart"></i>
                            @endauth
                        </div>
                        <span class="count">{{ $comment->likes->count() }}</span>
                    </div>
                </div>
            </div>
        @endforeach

        @if ($spot->comments->count() == 0)
            <div class="text-center mt-3">
                <p>There is no comment yet.</p>
            </div>
        @endif


    </div>
</div>
