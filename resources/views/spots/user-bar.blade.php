<div class="row mx-0 px-0 align-items-stretch">
    {{-- RIGHT: Stats --}}
    <div class="col-md-4 px-0 order-1 order-md-2">
        <div class="bg-white rounded-3 d-flex flex-column justify-content-center border-navy border-2 px-3 m-0 py-1 ms-md-2 mb-3 mb-md-0">
    
            {{-- Update Date - 右寄せ --}}
            <p class="fs-6 text-secondary text-end mb-0">
                UPDATE: {{ optional($spot->updated_at ?? $spot->created_at)->format('Y/m/d') }}
            </p>
    
            {{-- Like / Comment / Views - 横並び＋幅いっぱい --}}
            <div class="d-flex justify-content-center align-items-center w-100 fs-3">
                {{-- Like --}}
                <div class="d-flex align-items-center mx-3 mx-md-1 mx-lg-3">
                    <div class="like-button-wrapper position-relative d-inline-block">
                        <button 
                            class="btn-like-toggle border-0 bg-transparent p-0 @guest like-disabled @endguest"
                            data-spot-id="{{ $spot->id }}"
                            data-liked="{{ $spot->isLiked() ? '1' : '0' }}"
                        >
                            <i class="fa{{ $spot->isLiked() ? 's' : 'r' }} fa-heart fs-3 like-icon {{ $spot->isLiked() ? 'text-danger' : '' }}"></i>
                        </button>
    
                        @guest
                            <div class="login-tooltip d-none">
                                Please login to like this spot
                            </div>
                        @endguest
                    </div>
                    
                    
                    <span
                        class="fw-semibold ms-2 like-count"
                        role="button"
                        data-bs-toggle="modal"
                        data-bs-target="#likes-modal-{{ $spot->id }}"
                        onclick="refreshSpotLikesModal({{ $spot->id }})"
                    >
                        {{ $spot->likes->count() }}
                    </span>
                </div>
    
                {{-- Comment --}}
                <a href="#spot-comment-section" class="d-flex align-items-center mx-3 mx-md-1 mx-lg-3 text-decoration-none text-dark">
                    <i class="far fa-comment icon-mmd"></i>
                    <span class="fw-semibold ms-2">{{ $spot->spotcomments->count() }}</span>
                </a>
    
                {{-- Views --}}
                <div class="d-flex align-items-center mx-3 mx-md-1 mx-lg-3">
                    <i class="fas fa-chart-simple icon-mmd"></i>
                    <span class="fw-semibold ms-2">{{ $spot->views->sum('views') ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>

    {{-- LEFT: User Info --}}
    <div class="col-md-8 order-2 order-md-1">
        <div class="row d-flex flex-wrap align-items-center bg-white rounded-3  h-100">
            {{-- User Icon --}}
            <div class="col-auto m-2 align-items-center">
                <a href="{{ route('profile.header', $spot->user->id) }}" class="text-decoration-none h5 d-flex my-0">
                    @if($spot->user->avatar)
                        <img src="{{ $spot->user->avatar }}" class="avatar-md rounded-circle ms-0 ms-md-2" alt="icon">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-md text-center"></i>
                    @endif
                </a>
            </div>

            {{-- Username + Follow --}}
            <div class="col-auto align-items-center">
                <div class="d-flex align-items-center">
                    {{-- Username --}}
                    <a href="{{ route('profile.header', $spot->user->id) }}" class="text-decoration-none h5 d-flex align-items-center my-0 me-3">
                        <h1 class="username h5 poppins-semibold mb-0 me-2" id="username">{{ $spot->user->name }}</h1>

                    </a>

                    {{-- Follow Button --}}
                    @php
                        $authUser = Auth::user();
                        $owner = $spot->user;
                        $isFollowing = $authUser && $authUser->follows->contains('followed_id', $owner->id);
                    @endphp
                    @auth
                        @if ($authUser->role_id !== 2)
                            <form class="follow-toggle-form mb-0" data-user-id="{{ $owner->id }}">
                                @csrf
                                <button type="button" class="btn px-3 py-0 {{ $isFollowing ? 'btn-following' : 'btn-follow' }}">
                                    {{ $isFollowing ? 'Following' : 'Follow' }}
                                </button>
                            </form>
                        @endif
                    @endauth
                    
                </div>
            </div>


            {{-- SNS Icons --}}
            <div class="col text-end">
                <div class="d-flex justify-content-end p-2">
                    @if(!empty($spot->user->instagram))
                        <a href="https://instagram.com/{{ $spot->user->instagram }}" class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-instagram text-dark icon-md mx-1"></i>
                        </a>
                    @endif
                    @if(!empty($spot->user->facebook))
                        <a href="https://facebook.com/{{ $spot->user->facebook }}" class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-facebook text-dark icon-md mx-1"></i>
                        </a>
                    @endif
                    @if(!empty($spot->user->x))
                        <a href="https://x.com/{{ $spot->user->x }}" class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-x-twitter text-dark icon-md mx-1"></i>
                        </a>
                    @endif
                    @if(!empty($spot->user->tiktok))
                        <a href="https://www.tiktok.com/@{{ $spot->user->tiktok }}" class="text-decoration-none" target="_blank" rel="noopener">
                            <i class="fa-brands fa-tiktok text-dark icon-md mx-1"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div> 
</div>

@include('spots.likes-modal')
