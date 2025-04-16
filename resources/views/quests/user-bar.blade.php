<div class="bg-white rounded-3 mb-1">
    {{-- Update  date --}}
        <div class="col-auto pt-0 justify-content-center">
            <p class="xsmall text-secondary p-0 pe-2 text-end pt-lg-2 d-md-none">UPDATE: 2024/12/24</p>
        </div>
    {{-- Icon & Name & Official mark --}}
        <div class="d-flex flex-wrap align-items-center justify-content-center">


            {{-- User Icon --}}
            <div class="col-auto m-2 align-items-center">
                @php
                    $isOwnProfile = Auth::check() && Auth::id() === $quest_a->user->id;
                    $profileRoute = $isOwnProfile
                        ? route('myprofile.show')
                        : route('profile.show', ['id' => $quest_a->user->id]);
                @endphp

                <a href="{{ $profileRoute }}" class="text-decoration-none h5 d-flex my-0">
                    @if($quest_a->user->avatar)
                        <img src="{{ $quest_a->user->avatar }}" class="avatar-md rounded-circle ms-0 ms-md-2" alt="icon">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-mmd text-center"></i>
                    @endif
                </a>

            </div>
            {{-- User Name --}}
            <div class="col-md ms-3 pt-3 d-sm-none">
                <div class="row my-0">
                    <div class="col-auto px-0">
                        <a href="{{ $profileRoute }}" class="text-decoration-none h5 d-flex mb-0 pt-1">
                            <h1 class="username h5 poppins-semibold mb-0" id="username">{{ $quest_a->user->name }}</h1>
                        </a>                        
                    </div>
                    {{-- User official mark --}}                    {{-- User official mark --}}
                    @if(optional($quest_a->user)->official_certification == 2)
                        <div class="col-auto px-0">
                            <div class="col-auto p-0">
                                <img src="{{ asset('images/logo/official_personal.png')}}" class="avatar-xs ms-2" alt="official-personal">
                            </div>
                        </div>
                    @endif

                    {{-- Follow Button --}}
                    @php
                        $authUser = Auth::user();
                        $owner = $quest_a->user;
                        $isFollowing = $authUser && $authUser->follows->contains('followed_id', $owner->id);
                    @endphp

                    <div class="col-auto ps-3 mt-0 d-inline">
                        @auth
                            @if ($authUser->id !== $owner->id)
                                <form class="follow-toggle-form" data-user-id="{{ $owner->id }}">
                                    @csrf
                                    <button type="button" class="btn px-3 py-0 {{ $isFollowing ? 'btn-following' : 'btn-follow' }}">
                                        {{ $isFollowing ? 'Following' : 'Follow' }}
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>

                </div>
                {{-- Heart icon & Like function --}}
                 <div class="row pb-2">
                    <div class="d-flex align-items-center ps-0 justify-content-center">
                        <form id="like-form-{{ $quest_a->id }}" class="like-form" data-quest-id="{{ $quest_a->id }}">
                            <meta name="base-url" content="{{ url('/') }}">
                            @csrf
                            <button type="button" class="btn btn-sm shadow-none ps-0 like-btn">
                                <i class="fa{{ $quest_a->isLiked() ? 's' : 'r' }} fa-heart {{ $quest_a->isLiked() ? 'text-danger' : '' }}"></i>
                            </button>
                        </form>
    
                        <button class="btn btn-sm p-0 text-center open-likes-modal" data-bs-toggle="modal" data-bs-target="#likes-modal" data-quest-id="{{ $quest_a->id }}">
                            <span class="like-count" data-quest-id="{{ $quest_a->id }}">{{ $quest_a->questLikes->count() }}</span>
                        </button>
                        
                    {{-- Modal for displaying all users who liked owner of post--}}
                                                    
                    {{-- Comment icon & Number of comments --}}
                    <div class="col-auto d-flex ms-3">
                        <a href="#comment-section" class="btn btn-sm p-0 text-center">
                            <i class="fa-regular fa-comment"></i>
                        </a>

                        <a href="#comment-section" class="btn btn-sm p-0 text-center">
                            <p class="py-0 my-0 ps-2">{{ $quest_a->questcomments->count() }}</p>
                        </a>
                    </div>

                    {{--  --}}
                    <div class="col-auto d-flex ms-3">
                        <div>
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>

                        <button class="btn btn-sm p-0 text-center">
                            <p class="py-0 my-0 ps-2">
                                {{ $quest_a->views->sum('views') ?? 0 }}
                            </p>                           
                        </button>
                    </div>
                </div>
            </div>  
        </div>
        {{-- User Name for responsive--}}
        {{-- ↓レスポンシブ表示用（sm以上） --}}
        <div class="col-md ms-3 pt-3 d-none d-sm-block">
            <div class="row my-0">
                <div class="col-auto px-0">
                    <a href="{{ $profileRoute }}" class="text-decoration-none h5 d-flex mb-0 pt-1">
                        <h1 class="username h5 poppins-semibold mb-0" id="username">{{ $quest_a->user->name }}</h1>
                    </a>                    
                </div>
                {{-- User official mark --}}
                @if(optional($quest_a->user)->official_certification == 2)
                    <div class="col-auto px-0">
                        <div class="col-auto p-0">
                            <img src="{{ asset('images/logo/official_personal.png')}}" class="avatar-xs ms-2" alt="official-personal">
                        </div>
                    </div>
                @endif
                {{-- Follow Button --}}
                @php
                    $authUser = Auth::user();
                    $owner = $quest_a->user;
                    $isFollowing = $authUser && $authUser->follows->contains('followed_id', $owner->id);
                @endphp

                <div class="col-auto ps-md-3 mt-0 d-inline">
                    @auth
                        @if ($authUser->id !== $owner->id)
                            <form class="follow-toggle-form" data-user-id="{{ $owner->id }}">
                                @csrf
                                <button type="button" class="btn px-3 py-0 {{ $isFollowing ? 'btn-following' : 'btn-follow' }}">
                                    {{ $isFollowing ? 'Following' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>
        
            {{-- Heart icon & Like function --}}
             <div class="row pb-2">
                <div class="d-flex align-items-center ps-0">
                    <form id="like-form-{{ $quest_a->id }}" class="like-form" data-quest-id="{{ $quest_a->id }}">
                        <meta name="base-url" content="{{ url('/') }}">
                        @csrf
                        <button type="button" class="btn btn-sm shadow-none ps-0 like-btn">
                            <i class="fa{{ $quest_a->isLiked() ? 's' : 'r' }} fa-heart {{ $quest_a->isLiked() ? 'text-danger' : '' }}"></i>
                        </button>
                    </form>

                    <button class="btn btn-sm p-0 text-center open-likes-modal" data-bs-toggle="modal" data-bs-target="#likes-modal-{{ $quest_a->id }}" data-quest-id="{{ $quest_a->id }}">
                        <span class="like-count" data-quest-id="{{ $quest_a->id }}">{{ $quest_a->likes->count() }}</span>
                    </button>
                    
                {{-- Modal for displaying all users who liked owner of post--}}
                                                
                {{-- Comment icon & Number of comments --}}
                <div class="col-auto d-flex align-items-center ms-3">
                    <a href="#comment-section" class="btn btn-sm p-0 text-center">
                        <i class="fa-regular fa-comment icon-sm"></i>
                    </a>

                    <a href="#comment-section" class="btn btn-sm p-0 text-center">
                        <p class="py-0 my-0 ps-2">{{ $quest_a->questcomments->count() }}</p>
                    </a>
                </div>

                {{--  --}}
                <div class="col-auto d-flex ms-3">
                    <div>
                        <i class="fa-solid fa-chart-simple icon-sm"></i>
                    </div>

                    <p class="py-0 my-0 ps-2">
                        {{ $quest_a->views->sum('views') ?? 0 }}
                    </p>
                </div>
            </div>
        </div>  
    </div>
        <div class="col-4">
            {{-- ✅ Update日付（updated_at優先、なければcreated_at） --}}
            <div class="col-auto pt-0">
                <p class="xsmall text-secondary p-0 pe-2 text-end d-none d-md-block">
                    UPDATE: 
                    {{ optional($quest_a->updated_at ?? $quest_a->created_at)->format('Y/m/d') }}
                </p>
            </div>
            {{-- SNS icons --}}
            {{-- ✅ SNSアイコン（usernameが存在する場合のみ表示） --}}
            <div class="row justify-content-center pb-3">
                <div class="col-auto d-flex py-2">

                    @if(!empty($quest_a->user->instagram))
                        <a href="https://instagram.com/{{ $quest_a->user->instagram }}" class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-instagram text-dark icon-md px-0 mx-1 d-sm-block d-none"></i>
                            <i class="fa-brands fa-instagram text-dark icon-sm px-0 me-1 d-sm-none"></i>
                        </a>
                    @endif

                    @if(!empty($quest_a->user->facebook))
                        <a href="https://facebook.com/{{ $quest_a->user->facebook }}" class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-facebook text-dark icon-md px-0 mx-1 d-sm-block d-none"></i>
                            <i class="fa-brands fa-facebook text-dark icon-sm px-0 mx-1 d-sm-none"></i>
                        </a>
                    @endif

                    @if(!empty($quest_a->user->x))
                        <a href="https://x.com/{{ $quest_a->user->x }}" class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-x-twitter text-dark icon-md px-0 mx-1 d-sm-block d-none"></i>
                            <i class="fa-brands fa-x-twitter text-dark icon-sm px-0 mx-1 d-sm-none"></i>
                        </a>
                    @endif

                    @if(!empty($quest_a->user->tiktok))
                        <a href="https://www.tiktok.com/@{{ $quest_a->user->tiktok }}" class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-tiktok text-dark icon-md px-0 mx-1 d-sm-block d-none"></i>
                            <i class="fa-brands fa-tiktok text-dark icon-sm px-0 mx-1 d-sm-none"></i>
                        </a>
                    @endif

                </div>
            </div>
        </div>
</div>
@include('quests.modals.quest.likes-modal')
@vite(['resources/js/quest/view-quest.js', ])
