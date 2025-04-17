@section('css')
    <link rel="stylesheet" href="{{ asset('css/homebody.css')}}">
@endsection

{{-- @extends('layouts.app') --}}

    <div class="card p-3">

        {{-- Card Image with official mark --}}
        <img src="{{ asset('images/home/Official Badge.png') }}" class="official" alt="official">
        <a href="#" class="">
            {{-- @php
                $business_image_path = null;

                if($post->photo){
                    $priority_one = $post->photos->where('priority', '1')->first();
                    $business_image_path = $priority_one->image;
                }
                $image_path = $post->main_image ?? $business_image_path;
            @endphp --}}

            @if ($post->main_image)
                <img src="{{ asset('storage/' . $post->main_image) }}" class="card-img-top body-image" alt="image">
            @else
                <img src="{{ asset('images/home/noImage.jpg')}}" class="card-img-top body-image" alt="image">
            @endif

        </a>


        <div class="row align-items-center card-body ps-1">  
            <div class="row justify-content-between ms-1">
                {{-- Category --}}
                <div class="col-auto p-0">
                    <h5 class="card-subtitle">Category: 
                        <strong>
                            @php
                                $class = class_basename(get_class($post))
                            @endphp

                            @if ($class == 'Quest')
                                Quest
                            @elseif ($class == 'Spot')
                                Spot
                            @elseif ($class == 'Businesses' || $post->category_id == '1')
                                Location
                            @elseif ($class == 'Businesses' || $post->category_id == '2')
                                Event
                            @endif
                        </strong>
                    </h5>
                </div>
                
                {{-- Postdate --}}
                <div class="col-auto pe-0">
                    <h5 class="card-subtitle">{{ date('Y/m/d', strtotime($post->created_at)) }}</h5>
                </div>
            </div>                

            
            {{-- Title --}}
            <div class="mt-2">
                <a href="#" class="text-decoration-none">
                    <h4 class="card-title text-dark"><strong>{{ $post->name ?? $post->title }}</strong></h4>
                </a>
            </div>

            {{-- Icon & Name & Official mark --}}
            <div class="d-flex flex-wrap align-items-center personal_space">

                {{-- User Icon --}}
                <div class="col-auto ms-1">
                    <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                        @if ($post->user->avatar)
                            <img src="{{ $post->user->avatar }}" class="card-icon" alt="card-icon">
                        @else    
                            <img src="{{ asset('storage/images/home/free-user.png') }}" class="card-icon" alt="card-icon">
                        @endif
                    </a>
                </div>

                {{-- User Name --}}
                <div class="col-auto ms-1 pt-2">
                    <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                        <h1 class="username h5"><strong>{{ $post->user->name }}</strong></h1>
                    </a>
                </div>

                {{-- Javascript for character limit --}}
                <script>
                    document.querySelectorAll('.username').forEach(elem => {
                        const text = elem.textContent;

                        if (text.length > 10){
                        elem.textContent = text.substring(0, 10) + "...";
                        }
                    });
                </script>

                {{-- User official mark --}}
                <div class="col-auto pb-2">
                    <img src="{{ asset('images/home/名称未設定のデザイン (8) 1.png')}}" class="official-personal ms-2" alt="official-personal">
                </div>

                {{-- Follow Button --}}
                <div class="col-auto pb-2 ms-auto">
                    <form action="#" method="post" class="">
                        @csrf
                        
                        <button type="submit" class="btn btn-sm btn-follow-body">Follow</button>
                    </form>
                </div>
            </div>
            
            {{-- Heart icon & Like function --}}
            <div class="d-flex align-items-center">
                <form action="#" method="post">
                    @csrf

                    <button type="submit" class="btn btn-sm shadow-none">
                        <i class="fa-regular fa-heart"></i>
                    </button>
                </form>

                <button class="btn btn-sm p-0 text-center">
                    <span>{{ $post->likes->count() }}</span>
                </button>
                {{-- Modal for displaying all users who liked owner of post--}}
                                        

                
                {{-- Comment icon & Number of comments --}}
                <div class="col-auto d-flex ms-3">
                    <div>
                        <i class="fa-regular fa-comment h5"></i>
                    </div>

                    <button class="btn btn-sm p-0 text-center no-click">
                        <span>&nbsp;&nbsp;{{ $post->comments->count() }}</span>
                    </button>
                </div>

                {{--  --}}
                <div class="col-auto d-flex ms-3">
                    <div>
                        <img src="{{ asset('images/chart.png')}}" alt="">
                        {{-- <i class="fa-solid fa-chart-simple"></i> --}}
                    </div>

                    <button class="btn btn-sm p-0 text-center no-click">
                        <span>&nbsp;&nbsp;{{ $post->views->sum('views') ?? 0}}</span>
                    </button>
                </div>
            </div>

            {{-- Description of posts --}}
            <div>
                <p class="card_description">
                    {{ $post->introduction }}
            </div>
        </div>
    </div>

