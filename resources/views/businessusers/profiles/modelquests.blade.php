<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Posts')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
@endsection

@section('content')
    @include('businessusers.profiles.header')

<div class="row justify-content-center bg-blue">
    {{-- Model Quests --}}
    <div class="col-8 mb-3">
            {{-- Tabs for categories --}}
        <div class="row tag-category">
            <div class="col-auto">
                <a href="{{ route('profile.businesses', $user->id)}}" class="text-decoration-none text-dark" data-category="business">
                    <h3 class="poppins-semibold {{ request()->is('business/profile/businesses*') ? 'active' : '' }}">
                        Management Business
                    </h3>
                </a>
            </div>
            <div class="col-auto ms-5">
                <a href="{{ route('profile.promotions', $user->id) }}" class="text-decoration-none text-dark" data-category="promotions">
                    <h3 class="poppins-semibold {{ request()->is('business/profile/promotions*') ? 'active' : '' }}">
                        Promotions
                    </h3>
                </a>
            </div>
            <div class="col-auto ms-5">
                <a href="{{ route('profile.modelquests', $user->id) }}" class="text-decoration-none text-dark" data-category="quest">
                    <h3 class="poppins-semibold {{ request()->is('business/profile/modelquests*') ? 'active' : '' }}">
                        Model Quests
                    </h3>
                </a>
            </div>
        </div> 
        <hr>
        <div class="row">
            @if($user->id == Auth::user()->id)
            <div class="col-2 ms-auto mb-2">
                <a href="{{ route('quest.create', $user->id) }}" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
            @endif
        </div>

        <div class="row mb-1">
            @forelse($all_quests as $quest)
            <div class="col-lg-4 col-md-6 col-sm"> 
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Image --}}   
                        {{-- <div class="business">                         
                            <div class="photos"> --}}
                                @if($quest->main_image)
                                    <img src="{{ $quest->main_image }}" alt="" class="post-image">
                                @else
                                    No photo
                                @endif
                            {{-- </div>
                        </div> --}}
                    </div>
                    <div class="card-body content">  
                        <div class="row mb-3">
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                @if($quest->created_at)
                                    <h5 class="card-subtitle"><span>{{date('H:i, M d Y', strtotime($quest->created_at))}}</span></h5>
                                @endif
                            </div>
                        </div> 
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">{{ $quest->title }}</h4>
                                </a>
                            </div>
                        </div>

                        {{-- Duration --}}
                        <div class="row">
                            <div class="col p-0">
                                @if($quest->duration)
                                <h5 class="fw-bold">Quest duration: <span>{{$quest->duration}}</span> {{$quest->duration==1 ? 'day' : 'days'}}</h5>
                            @else
                                <p>Quest duration: Not defined</p>
                            @endif
                            </div>  
                        </div> 

                        {{-- Heart icon & Like function --}}
                        <div class="row align-items-center">
                            <div class="col-1 ms-2 p-0 mt-3">
                                {{-- like/heart button --}}
                                @if($quest->isLiked())
                                    {{-- red heart/unlike --}}
                                    <form action="{{route('quest.like.delete', $quest->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn p-0">
                                            <i class="fa-solid fa-heart text-danger"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{route('quest.like.store', $quest->id)}}" method="post">
                                        @csrf
                                        <button type="sumbit" class="btn p-0">
                                            <i class="fa-regular fa-heart"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                            <div class="col-2 ms-1 px-2">
                            {{-- no. of likes --}}
                            @if($quest->questLikes->count()>0)

                            <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#show-likes{{$quest->id}}">
                                {{$quest->questLikes->count()}}
                            </button>

                            @else
                                0
                            @endif
                            </div>
                            {{-- Modal for displaying all users who liked owner of post--}}
                                                                            
                            {{-- Comment icon & Number of comments --}}
                            <div class="col-1 ms-3 p-0">
                                <div>
                                    <i class="fa-regular fa-comment"></i>
                                </div>
                            </div>
                            <div class="col-2 ms-1 px-0">
                                <button class="dropdown-item text-dark">
                                    {{$quest->questComments->count()}}
                                </button>
                            </div>
    
                            {{-- Number of viewers --}}
                            <div class="col-1 ms-3 p-0">
                                <div>
                                    <img src="{{ asset('images/chart.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-2 ms-1 px-0">
                                <button class="dropdown-item text-dark">
                                    201
                                </button>
                            </div>
                        </div>
           
                        {{-- Description of posts --}}
                        <div class="row">
                            <div class="col p-0">
                                <p class="card_description">
                                    {{$quest->introduction}} 
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
                                    @if($quest->trashed())
                                        Status: <i class="fa-solid fa-circle color-red"></i> Hidden
                                    @else
                                        Status: <i class="fa-solid fa-circle color-green"></i> Visible
                                    @endif
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('quest.edit', $quest->id) }}" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                                </div>
                                <div class="col-6">
                                    @if($quest->trashed())
                                    {{-- activate --}}
                                        <button class="btn btn-outline-green w-100" data-bs-toggle="modal" data-bs-target="#activate-quest{{$quest->id}}">
                                            UNHIDE
                                        </button>
                                    @else
                                        <button class="btn btn-red w-100" data-bs-toggle="modal" data-bs-target="#deactivate-quest{{ $quest->id }}">
                                            HIDE
                                        </button>
                                    @endif
                                    @include('businessusers.posts.modelquests.modals.hide_unhide')
                                </div>

                            </div>
                    </div>  
                    @endif

                </div>
            </div>
            @empty
                <h4 class="h4 text-center text-secondary">No posts yet</h4>
            @endforelse 
        </div>
        <div class="d-flex justify-content-end mb-5">
            {{ $all_quests->links() }}
        </div>
    </div>
</div>
</div>
@endsection
