<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Posts')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}"> 
@endsection

@section('content')

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
<div class="row justify-content-center mt-2 mb-0">        
    <div class="col-8">
        <div class="profile-header position-relative"> 
            <div class="row">
                <!-- Avatar image -->
                <div class="col-md-auto col-sm profile-image mb-3">
                    @if($user->avatar)
                        <img src="{{$user->avatar}}" alt="" class="rounded-circle avatar-xxl">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-xl d-block text-center"></i>
                    @endif
                </div>
                {{-- <div class="col-2"></div> --}}
                <!-- Username -->
                <div class="col-md col-sm">
                    <div class="row">   
                        <div class="col-md-auto col-sm-8">
                            <h3 class="mb-1 text-truncate fw-bold pb-2">{{ $user->name }}</h3>
                        </div>
                        <div class="col-md-1 col-sm-1 pb-2 p-1">
                            @if($user->official_certification == 2)
                                <img src="{{ asset('images/logo/official_personal.png')}}" class="official-personal d-inline ms-0 avatar-xs" alt="official-personal"> 
                            @endif
                        </div>
                        @if($user->id == Auth::user()->id)
                            {{-- edit profile --}}
                            <div class="col-md-2 col-sm-3 ms-auto">
                                <a href="{{route('profile.edit', Auth::user()->id)}}" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-md-2 col-sm-3">
                                <button class="btn btn-sm btn-red mb-2 w-100 " data-bs-toggle="modal" data-bs-target="#delete-profile">DELETE</button>
                            </div>
                        @elseif(Auth::user()->role_id == 1)
                            <div class="col-md-2 col-sm-2 ms-auto">
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
                        <!--Post-->
                        <div class="col-auto">
                            @if($user->id == Auth::user()->id)
                                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->businessPromotions->count()+$user->businesses->count()+$user->quests->count()}}</span> {{$user->businessPromotions->count()+$user->businesses->count()+$user->quests->count()==1 ? 'post' : 'posts'}}</a>
                            @elseif($user->id != Auth::user()->id)
                                <a href="{{ route('profile.businesses', $user->id) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->businessPromotionsVisible->count()+$user->businessesVisible->count()+$user->questsVisible->count()}}</span> {{$user->businessPromotionsVisible->count()+$user->businessesVisible->count()+$user->questsVisible->count()==1 ? 'post' : 'posts'}}</a>
                            @endif
                        </div>
                        <!--Follower-->
                        <div class="col-auto">
                            <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'followers']) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->followers->count()}}</span> {{$user->followers->count()==1 ? 'follower' : 'followers'}}</a>
                        </div>
                        @if($user->id == Auth::user()->id)
                        <div class="col-auto">
                            @if($user->id == Auth::user()->id)                             
                                <a href="{{ route('profile.allreviews', $user->id)}}" class="text-decoration-none text-dark"><span class="fw-bold">{{$business_comments->count()}}</span> {{$business_comments->count()==1 ? 'review' : 'reviews'}}</a>
                            @endif
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

               {{-- === タブ切り替えエリア === --}}
            @if (!$section)
               <ul class="nav nav-tabs custom-tabs mt-4" role="tablist">
                   <li class="nav-item">
                       <a class="nav-link {{ $tab == 'businesses' ? 'active-tab' : '' }}"
                           href="{{ route('profile.header', ['id' => $user->id, 'tab' => 'businesses']) }}">
                           Management Business
                       </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link {{ $tab == 'promotions' ? 'active-tab' : '' }}"
                           href="{{ route('profile.header', ['id' => $user->id, 'tab' => 'promotions']) }}">
                           Promotions
                       </a>
                   </li>
                   <li class="nav-item">
                       <a class="nav-link {{ $tab == 'quests' ? 'active-tab' : '' }}"
                           href="{{ route('profile.header', ['id' => $user->id, 'tab' => 'quests']) }}">
                           Model Quests
                       </a>
                   </li>
               </ul>
           @endif

    {{-- === コンテンツ表示（Switch） === --}}
    
        <div class="row justify-content-center mt-5">
        <!--Follower-->    
                <div class="col-6">
                    <div class="row mb-3 align-items-center ">
                        @if ($section == 'followers')
                            <h3 class="text-center mb-3">Followers</h3>                            
                            <ul class="list-group">
                                @forelse($user->followers as $follower)  
                                    <div class="row bg-white p-2 rounded-4 mb-3 d-flex align-items-center">                 
                                        <div class="col-auto">
                                            {{-- icon/avatar --}}
                                            {{-- <a href="{{route('profile.show', $follower->follower->id)}}"> --}}
                                            <a href="#">
                                                @if($follower->follower->avatar)
                                                    <img src="{{$follower->follower->avatar}}" alt="" class="rounded-circle avatar-sm">
                                                @else
                                                        <i class="fa-solid fa-circle-user text-secondary profile-sm"></i>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="col ps-0 text-truncate">
                                            {{-- name --}}
                                            {{-- <a href="{{route('profile.show', $follower->follower->id)}}" 
                                                class="text-decoration-none text-dark fw-bold"> --}}
                                            <a href="#" class="text-decoration-none text-dark fw-bold">
                                                {{$follower->follower->name}}
                                            </a>
                                        </div>
                                        <div class="col-auto mt-3">
                                            {{-- button --}}
                                            @if($follower->follower->id != Auth::user()->id)
                                                @if($follower->follower->isFollowed())
                                                    {{-- unfollow --}}
                                                    <form action="{{route('follow.delete', $follower->follower->id)}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-following ">Following</button>
                                                    </form>
                                                @else  
                                                    {{-- follow --}}
                                                    <form action="{{route('follow.store', $follower->follower->id)}}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn-follow ">Follow</button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </div> 
                                @empty
                                    <h4 class="h4 text-center text-secondary">No followers yet</h4>
                                @endforelse   
                            </ul>
                        @else
                    </div>
                </div>
                            @switch($tab)
                                @case('businesses')
                                    @include('businessusers.profiles.businesses', ['businesses' => $businesses])
                                    @break
                                @case('promotions')
                                    @include('businessusers.profiles.promotions', ['promotions' => $promotions])
                                    @break
                                @case('quests')
                                    @include('businessusers.profiles.quests', ['quests' => $quests])
                                    @break
                                @default
                                    @include('businessusers.profiles.businesses', ['businesses' => $businesses])
                            @endswitch
                        @endif
        </div>
    </div>   
</div>
@endsection



