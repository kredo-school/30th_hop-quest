<link rel="stylesheet" href="{{ asset('css/comment.css') }}">

<!-- Comments Section -->
<div class="comment-section">
    <div class="w-full mt-2">
        <h5 class="font-normal comment-count">
            Comments({{ $quest_a->questcomments->count() }})
        </h5>

        {{-- コメント送信フォーム --}}
        @auth
            <form action="{{ route('questcomment.store', $quest_a->id) }}" method="POST">
                @csrf
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
    </div>

    {{-- コメント一覧 --}}
    @if($quest_a->questcomments->isNotEmpty())
        <div class="comment-container">
            @foreach($quest_a->questcomments as $comment)
                <div class="comment-content">
                    @auth
                        {{-- ゴミ箱アイコン（本人のみ表示） --}}
                        @if(Auth::user()->id === $comment->user_id)
                            <button class="comment-trash" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $comment->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            {{-- Include Delete Modal --}}
                            @include('quests.comment.modals.delete', ['comment' => $comment, 'quest_a' => $quest_a])
                        @endif
                    @endauth

                    {{-- コメント投稿者の情報 --}}
                    <div class="comment-header my-2">
                        <div class="comment-user-icon">
                            <a href="">
                                {{-- {{ route('profile.show', $comment->user->id) }} --}}
                                @if ($comment->user->avatar)
                                    <img src="{{ asset('storage/' . $comment->user->avatar) }}" class="avatar-sm" alt="icon">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary icon-md"></i>
                                @endif
                            </a>
                        </div>
                        <div class="comment-username">
                            <a href="#" class="text-decoration-none h5 d-flex align-items center">
                                {{-- {{ route('profile.show', $comment->user->id) }} --}}
                                <h1 class="username h6" id="username"><strong>{{ $comment->user->name }}</strong></h1>
                            </a>
                        </div>
                        <div class="comment-date" id="date">
                            <p class="text-decoration-none d-flex align-items-center">{{ date('M d, Y', strtotime($comment->created_at)) }}</p>
                        </div>
                    </div>

                    {{-- コメント内容 --}}
                    <div class="comment-text col-auto px-2">
                        <p class="">{{ $comment->content }}</p>
                    </div>

                    {{-- いいねなどのアクション --}}
                    <div class="comment-actions d-flex justify-content-end gap-3">
                        <div class="comment-action-item">
                            <form action="{{ route('questcomment.toggleLike', $comment->id) }}" method="POST" data-comment-id="{{ $comment->id }}" class="like-comment-form">
                                
                                @csrf
                                <button type="submit" class="btn btn-sm shadow-none comment-like-btn">
                                    <i class="{{ $comment->QuestCommentlikes->where('user_id', Auth::id())->isNotEmpty() ? 'fa-solid text-danger' : 'fa-regular' }} fa-heart"></i>
                                </button>
                            </form>
                            <button class="btn btn-sm p-0 text-center open-comment-likes-modal"
                                data-bs-toggle="modal"
                                data-bs-target="#comment-likes-modal-{{ $comment->id }}"
                                data-comment-id="{{ $comment->id }}">
                                <span class="count comment-like-count" data-comment-id="{{ $comment->id }}">
                                    {{ $comment->QuestCommentlikes->count() }}
                                </span>
                            </button>

                        </div>
                        <div class="comment-action-item">
                            <i class="fa-solid fa-chart-simple"></i>
                            <button class="btn btn-sm p-0 text-center">
                                <span class="count">0</span> {{-- 閲覧数機能が必要なら別途追加 --}}
                            </button>
                        </div>
                    </div>
                </div>
                @include('quests.comment.modals.like')
                @endforeach
            </div>
        @endif

        @vite('resources/js/quest/comment/quest-comment.js')

