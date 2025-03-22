<link rel="stylesheet" href="{{asset('css/style.css')}}"> 
<!-- Header image -->
    <div class="row">
        <div class="mb-3 pt-3">
            @if($user->header)
                <img src="{{$user->header}}" alt="" class="header-image">
            @else
                <img src="{{ asset('images/logo/header_logo.jpg') }}" alt="header_logo" class="header-image">
            @endif
        </div>
    </div> 
{{-- User information --}}
<div class="row justify-content-center mt-2 mb-4">        
    <div class="col-8">
        <div class="profile-header position-relative"> 
            <div class="row">
                <!-- Avatar image -->
                <div class="col-auto profile-image mb-3">
                    @if($user->avatar)
                        <img src="{{$user->avatar}}" alt="" class="rounded-circle avatar-xxl">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-xl d-block text-center"></i>
                    @endif
                </div>
                {{-- <div class="col-2"></div> --}}
                <!-- Username -->
                <div class="col">
                    <div class="row">
                        
                        <div class="col-auto">
                            <h3 class="mb-1 text-truncate">{{ $user->name }}</h3>
                        </div>
                        <div class="col-1 pb-2 p-1">
                            @if($user->official_certification == 1)
                            <img src="{{ asset('images/logo/official_personal.png')}}" class="official-personal d-inline ms-0 avatar-xs" alt="official-personal"> 
                            @endif
                        </div>
                        @if($user->id == Auth::user()->id)
                        {{-- edit profile --}}
                        <div class="col-2 ms-auto">
                            <a href="{{route('profile.edit')}}" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-sm btn-red mb-2 w-100 " data-bs-toggle="modal" data-bs-target="#delete-profile">DELETE</button>
                        </div>
                        @else
                            <div class="col-2 ms-auto">
                                @if($user->isFollowed())
                                {{-- unfollow --}}
                                    <form action="{{route('follow.delete', $user->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-following fw-bold mb-2 w-100">Following</button>
                                    </form>
            
                                @else
                                {{-- follow --}}
                                <form action="{{route('follow.store', $user->id )}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-follow fw-bold mb-2 w-100">Follow</button>
                                </form>
                                @endif 
                            </div> 
                        @endif
                    </div>  
                    @include('businessusers.profiles.modals.delete')  
                
                    {{-- url --}}
                    <div class="row mb-3">
                        <div class="col">
                            @if($user->website_url)
                                <a href="#" class="text-decoration-none text-dark ">{{ $user->website_url }}</a>
                            @endif
                        </div>
                    </div> 
                    
                    {{-- items --}}
                    <div class="row mb-3">
                        <div class="col-auto">
                            <a href="{{ route('profile.promotions', $user->id) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->promotions->count()}}</span> {{$user->promotions->count()==1 ? 'post' : 'posts'}}</a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('profile.followers', $user->id)}}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->followers->count()}}</span> {{$user->followers->count()==1 ? 'follower' : 'followers'}}</a>
                        </div>
                        @if($user->id == Auth::user()->id)
                        <div class="col-auto">
                            <a href="{{ route('profile.reviews', $user->id)}}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->reviews->count()}}</span> {{$user->reviews->count()==1 ? 'review' : 'reviews'}}</a>
                        </div>
                        @endif

                        {{-- SNS icons --}}
                        <div class="col-auto ms-auto">
                            @if($user->instagram)
                                <a href="#" class="text-decoration-none">
                                <i class="fa-brands fa-instagram text-dark icon-md px-4"></i>
                                </a>
                            @endif
                            @if($user->facebook)
                                <a href="#" class="text-decoration-none">
                                <i class="fa-brands fa-facebook text-dark icon-md px-4"></i>
                                </a>
                            @endif
                            @if($user->x)
                                <a href="#" class="text-decoration-none">
                                <i class="fa-brands fa-x-twitter text-dark icon-md px-4"></i>
                                </a>
                            @endif
                            @if($user->tiktok)
                                <a href="#" class="text-decoration-none">
                                <i class="fa-brands fa-tiktok text-dark icon-md px-4"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div> 
            </div>
            {{-- introduction --}}
            <div class="row mb-3">
                @if($user->introduction)
                    <p>{{ $user->introduction}}</p>
                @endif               
            </div>
            
        </div>
    </div>
    
</div>




