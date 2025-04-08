@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
@endsection


    <div class="card p-3">
        <div class="card-header border-0 bg-light p-0 overflow-hidden">
            <!-- Official mark -->
            @if($post['official_certification']==3)
                <img src="{{ asset('images/logo/Official_Badge.png') }}" class="official" alt="official">              
            @elseif($post['official_certification'] == 1 || $post['official_certification'] == 2)
            @endif
            <!--Main_Image-->
            @if($post['type'] == 'businesses')
                <a href="#" >
                    <img src="{{ $post['main_image'] }}" alt="{{ $post['title'] }}" class="post-image">
                </a>
            @elseif($post['type'] == 'promotions')
                <a href="{{ route('promotions.show', $post['id']) }}" >
                    <img src="{{ $post['main_image'] }}" alt="{{ $post['title'] }}" class="post-image">
                </a>
            @elseif($post['type'] == 'quests')
                <a href="#" >
                    <img src="{{ $post['main_image'] }}" alt="{{ $post['title'] }}" class="post-image">
                </a>
            @endif
        </div>

        @if($post['type'] == 'businesses')
            <div class="card-body content"> 
        @elseif($post['type'] == 'quests')
            <div class="card-body content-long"> 
        @elseif($post['type'] == 'promotions')
            <div class="card-body">  
        @endif
            <div class="row mb-3">
                @if ($post['type']== 'businesses')
                <!-- Category -->
                    <div class="col-md-auto col-sm-12 p-0">
                        <h5 class="card-subtitle">Category: 
                            @if($post['category_id']==1)
                                <strong>Location</strong>
                            @elseif($post['category_id']==2)
                                <strong>Event</strong>
                            @endif
                        </h5>
                    </div>
                @endif
                
                <!-- Related business of promotion -->
                @if($post['tab_id']==3)
                <div class="col-md-auto col-sm-12 p-0">
                    <h5 class="card-subtitle fw-bold">{{ $post['business_name']}}</h5>
                </div>
                @endif
                <!-- Postdate -->
                <div class="col-md-auto col-sm-12 pe-0 ms-auto">
                    <h5 class="card-subtitle">{{ $post['created_at']->format('H:i, M d Y')}}</h5>
                </div>
            </div>                

            
            <!-- Title -->
            <div class="row mb-1">
                <div class="col p-0">
                    <a href="#" class="text-decoration-none">
                        <h4 class="card-title text-dark fw-bold">{{ $post['title'] }}</h4>
                    </a>
                </div>
            </div>

            <!-- Duration -->
            @if($post['tab_id']==4)
                <div class="row">
                    <div class="col p-0">
                        @if($post['duration'])
                            <h5 class="fw-bold"><span>Duration: {{$post['duration']}}</span> {{$post['duration']==1 ? 'day' : 'days'}}</h5>
                        @else
                            <p>Quest duration: Not defined</p>
                        @endif
                    </div>  
                </div> 
            @elseif($post['tab_id']==3)
            <div class="row">
                <div class="col p-0">
                    @if($post['promotion_start'])
                        <h5 class="fw-bold">{{date('M d Y', strtotime($post['promotion_start']))}} ~ {{date('M d Y', strtotime($post['promotion_end']))}}</h5>
                    @endif
                </div>  
            </div> 
            @endif
            
            @if($post['type'] == 'businesses' || $post['type'] == 'quests')
            {{-- Heart icon & Like function --}}
            <div class="row align-items-center ">
                <div class="col-1 ms-2 p-0 mt-3">
                    {{-- like/heart button --}}
                    @if($post['is_liked'])
                        @php
                            $likeDeleteRoute = $post['type'] . '.like.delete';
                        @endphp
                        {{-- red heart/unlike --}}
                        <form action="{{ route($likeDeleteRoute, $post['id']) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn p-0">
                                <i class="fa-solid fa-heart color-red {{ $post['is_liked'] ? 'text-danger' : 'text-secondary' }}" ></i>
                            </button>
                        </form>
                    @else
                        @php
                            $likeStoreRoute = $post['type'] . '.like.store'; // 例: 'quest.like.store'
                        @endphp
                        <form action="{{ route($likeStoreRoute, $post['id']) }}" method="post">
                            @csrf
                            <button type="sumbit" class="btn p-0">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </form>
                    @endif
                </div>

                <div class="col-2 ms-1 px-2">
                    <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                        <span>{{ $post['likes_count'] }}</span>
                    </button>
                </div>
                {{-- Modal for displaying all users who liked owner of post--}}
                                                                
                {{-- Comment icon & Number of comments --}}
                <div class="col-1 ms-3 p-0">
                    <div>
                        <i class="fa-regular fa-comment"></i>
                    </div>
                </div>
                <div class="col-2 ms-1 px-0">
                    <span>{{ $post['comments_count'] }}</span>
                </div>

                {{-- Number of viewers --}}
                <div class="col-1 ms-3 p-0">
                    <div>
                        <img src="{{ asset('images/chart.png') }}" alt="">
                    </div>
                </div>
                <div class="col-2 ms-1 px-0">
                    <button class="dropdown-item text-dark">
                        {{-- <span>{{ $post['views_count'] }}</span> --}}
                    </button>
                </div>
            </div>
            @endif

            {{-- Description of posts --}}
            <div class="row">
                <div class="col p-0">
                    <p class="card_description">
                        {{ $post['introduction']}}
                    </p>
                </div>    
            </div>
        </div>

        @if($user->id == Auth::user()->id)
                <div class="card-footer bg-white">
                    {{-- status --}}
                        <div class="row ">
                            <div class="col p-0 mb-3">
                                {{-- visibility --}}
                                @if($post['is_trashed'])
                                    Status: <i class="fa-solid fa-circle color-red"></i> Hidden
                                @else
                                    Status: <i class="fa-solid fa-circle color-green"></i> Visible
                                @endif
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-6">
                                @php
                                    $postEditRoute = $post['type'] . '.edit';
                                @endphp
                                <a href="{{ route($postEditRoute, $post['id']) }}" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-6">
                                @if($post['is_trashed'])                  
                                    @php
                                        $modalId = 'activate-' . $post['type'] . $post['id'];
                                    @endphp
                                    <button class="btn btn-outline-green w-100" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                        UNHIDE
                                    </button>
                                @else
                                    @php
                                        $modalId = 'deactivate-' . $post['type'] . $post['id'];
                                    @endphp
                                    <button class="btn btn-red w-100" data-bs-toggle="modal" data-bs-target="#{{ $modalId }}">
                                        HIDE
                                    </button>
                                @endif
                                @include("businessusers.posts.{$post['type']}.modals.hide_unhide", [
                                    'post' => $post,
                                    'modalId' => $modalId,
                                ])
                            </div>
                        </div>
                </div> 
            
        @endif
    </div>
