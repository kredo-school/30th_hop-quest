@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
@endsection


    <div class="card p-3">
        <div class="card-header border-0 bg-light p-0 overflow-hidden">
            {{-- Card Image with official mark --}}
            @if($post['official_certification']==3)
                <img src="{{ asset('images/logo/Official_Badge.png') }}" class="official" alt="official">              
            @else
            @endif
            @if($post['type'] == 'businesses')
                <a href="{{route('business.show', $post['id'])}}" >
                    @if(Str::startsWith($post['main_image'], 'http') || Str::startsWith($post['main_image'], 'data:'))
                        <img src="{{ $post['main_image'] }}" alt="{{ $post['title'] }}" class="post-image">
                    @else
                        <img src="{{ asset('storage/' . $post['main_image']) }}" alt="{{ $post['title'] }}" class="post-image">
                    @endif
                </a>
            @elseif($post['type'] == 'spots')
                <a href="{{ route('spot.show', $post['id']) }}" >
                    @if(Str::startsWith($post['main_image'], 'http') || Str::startsWith($post['main_image'], 'data:'))
                        <img src="{{ $post['main_image'] }}" alt="{{ $post['title'] }}" class="post-image">
                    @else
                        <img src="{{ asset('storage/' . $post['main_image']) }}" alt="{{ $post['title'] }}" class="post-image">
                    @endif
                </a>
            @elseif($post['type'] == 'quests')
                <a href="{{route('quest.show', $post['id'])}}" >
                    @if(Str::startsWith($post['main_image'], 'http') || Str::startsWith($post['main_image'], 'data:'))
                        <img src="{{ $post['main_image'] }}" alt="{{ $post['title'] }}" class=" post-image">
                    @else
                        <img src="{{ asset('storage/' . $post['main_image']) }}" alt="{{ $post['title'] }}" class="post-image">
                    @endif
                </a>
            @endif
        </div>

        <div class="card-body content-lg">  
            <div class="row mb-3">
                @if (Request::is('home/posts/all*') || Request::is('home/posts/followings*'))
                {{-- Category --}}
                    <div class="col-md-auto col-sm-12 p-0">
                        <h5 class="card-subtitle">Category: 
                            @if($post['tab_id']==1)
                                <strong>Spot</strong>
                            @elseif($post['tab_id']==2)
                                <strong>Quest</strong>
                            @elseif($post['tab_id']==3)
                                <strong>Location</strong>
                            @elseif($post['tab_id']==4)
                                <strong>Event</strong>
                            @endif
                        </h5>
                    </div>
                @endif
                
                {{-- Postdate --}}
                <div class="col-md-auto col-sm-12 pe-0 ms-auto">
                    <h5 class="card-subtitle">{{ $post['created_at']->format('H:i, M d Y')}}</h5>
                </div>
            </div>                

            
            {{-- Title --}}
            <div class="row mb-2">
                <div class="col p-0">
                    <a href="#" class="text-decoration-none">
                        <h4 class="card-title text-dark fw-bold">{{ $post['title'] }}</h4>
                    </a>
                </div>
            </div>
            {{-- Icon & Name & Official mark --}}
            <div class="row align-items-center personal_space">
                {{-- User Icon --}}
                <div class="col-md-auto col-sm-2 my-auto p-0">                   
                    <button class="btn">
                        @if($post['avatar'])
                            <img src="{{ $post['avatar'] }}" alt="" class="rounded-circle avatar-sm">
                        @else
                            <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                        @endif
                    </button>
                </div>
            
                {{-- User Name --}}
                <div class="col-md-auto col-sm-6 ms-2 p-0">
                    <a href="#" class="text-decoration-none h5 d-inline align-items-center">
                        <p class="username h4 my-auto" id="username">{{ $post['user_name'] }}</p></a>                 
                </div>

                {{-- Javascript for character limit --}}
                <script>
                    document.querySelectorAll('.username').forEach(elem => {     //変更①　idではなくclassから引っ張ってくる。
                        const text = elem.textContent;   //変更②　前まではusernameElemという変数を使っていましたが、上記の理由からただのelemに変更。
                        if (text.length > 15){
                        elem.textContent = text.substring(0, 15) + "...";　//変更③　変更②と同じ修正です。
                        }
                    });
                </script>

                {{-- User official mark --}}
                <div class="col-md-auto col-sm-1 pb-2 p-1">
                    @if($post['user_official_certification'] == 2)
                        <img src="{{ asset('images/logo/official_personal.png')}}" class="official-personal d-inline ms-0" alt="official-personal">
                    @elseif($post['user_official_certification'] == 1)
                    @endif
                </div>

                {{-- Follow Button --}}
                @if($post['user_id'] != Auth::user()->id)
                    <div class="col-md-auto col-sm ms-auto p-0 mt-3">
                        @if ($post['user']->isFollowed())
                            <form method="POST" action="{{ route('follow.delete', $post['user']->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-following mb-2 w-100">Following</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('follow.store', $post['user']->id) }}">
                                @csrf
                                <button type="submit" class="btn-follow mb-2 w-100">Follow</button>
                            </form>
                        @endif
                    </div> 
                @endif
            </div>
            
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
                        <span>{{ $post['views_sum'] ?? 0 }}</span>
                    </button>
                </div>
            </div>

            {{-- Description of posts --}}
            <div class="row">
                <div class="col p-0">
                    <p class="card_description">
                        {{ $post['introduction']}}
                    </p>
                </div>    
            </div>
        </div>
    </div>
