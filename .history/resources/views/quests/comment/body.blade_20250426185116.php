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
    @if ($quest_a->questcomments->isNotEmpty())
        @foreach ($quest_a->questcomments as $comment)
            <div class="comment-container">
                <div class="comment-content">
                    @auth
                        {{-- ゴミ箱アイコン（本人のみ表示） --}}
                        @if (Auth::user()->id === $comment->user_id)
                            <button class="comment-trash" data-bs-toggle="modal"
                                data-bs-target="#deleteModal-{{ $comment->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            {{-- Include Delete Modal --}}
                            @include('quests.comment.modals.delete', [
                                'comment' => $comment,
                                'quest_a' => $quest_a,
                            ])
                        @endif
                    @endauth

                    {{-- コメント投稿者の情報 --}}
                    {{-- コメント投稿者の情報 --}}
                    <div class="comment-header my-2 d-flex align-items-center">

                        {{-- アバターリンク --}}
                        <a href="{{ route('profile.header', ['id' => $comment->user_id]) }}"
                            class="text-decoration-none d-flex align-items-center me-2">
                            @if ($comment->user->avatar)
                                @if (Str::startsWith($comment->user->avatar, 'http') || Str::startsWith($comment->user->avatar, 'data:'))
                                    <img src="{{ $comment->user->avatar }}" alt="{{ $comment->user->name }}"
                                        class="rounded-circle avatar-sm">
                                @else
                                    <img src="{{ asset($comment->user->avatar) }}" alt="{{ $comment->user->name }}"
                                        class="rounded-circle avatar-sm">
                                @endif
                            @else
                                <i
                                    class="fa-solid fa-circle-user text-secondary text-decoration-none profile-sm text-center"></i>
                            @endif
                        </a>

                        {{-- ユーザー名リンク --}}
                        <div class="d-flex align-items-center flex-wrap">
                            <a href="{{ route('profile.header', $comment->user->id) }}"
                                class="text-decoration-none poppins-semibold text-dark">
                                <span class="username h6 mb-0"><strong>{{ $comment->user->name }}</strong></span>
                            </a>
                            {{-- 認証バッジ（任意） --}}
                            {{-- @if (optional($comment->user)->official_certification == 2)
                                <img src="{{ asset('images/logo/official_personal.png') }}" class="avatar-xs ms-2" alt="official badge">
                            @endif --}}
                        </div>

                        {{-- 日付 --}}
                        <div class="ms-auto text-muted small">
                            {{ date('M d, Y', strtotime($comment->created_at)) }}
                        </div>
                    </div>


                    {{-- コメント内容 --}}
                    <div class="comment-text col-auto px-2">
                        <p class="">{{ $comment->content }}</p>
                    </div>

                    {{-- いいねなどのアクション --}}
                    <div class="comment-actions d-flex justify-content-end gap-3">
                        <div class="comment-actions d-flex justify-content-end gap-3">
                            <div
                                class="comment-action-item d-flex align-items-center position-relative like-button-wrapper">
                                <form action="{{ route('questcomment.toggleLike', $comment->id) }}" method="POST"
                                    data-comment-id="{{ $comment->id }}" class="like-comment-form me-1">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm shadow-none comment-like-btn @guest like-disabled @endguest">
                                        <i
                                            class="{{ $comment->QuestCommentlikes->where('user_id', Auth::id())->isNotEmpty() ? 'fa-solid text-danger' : 'fa-regular' }} fa-heart"></i>
                                    </button>
                                </form>

                                @guest
                                    <div class="login-tooltip d-none">
                                        Please login to like comments
                                    </div>
                                @endguest

                                <button class="btn btn-sm p-0 text-center open-comment-likes-modal"
                                    data-bs-toggle="modal" data-bs-target="#comment-likes-modal-{{ $comment->id }}"
                                    data-comment-id="{{ $comment->id }}">
                                    <span class="count comment-like-count" data-comment-id="{{ $comment->id }}">
                                        {{ $comment->QuestCommentlikes->count() }}
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @include('quests.comment.modals.like')
            </div>
        @endforeach
    @endif

    @vite('resources/js/quest/comment/quest-comment.js')
