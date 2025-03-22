<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Posts')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
@endsection

@section('content')
    @include('businessusers.profiles.header')

<div class="mb-5 row justify-content-center bg-blue">
{{-- Management business --}}
    <div class="col-8 mb-3">
        <div class="row">
            <div class="col">
                <h3>Management Business</h3>
            </div>
            @if($user->id == Auth::user()->id)
            <div class="col-2">
                <a href="#" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
            @endif
        </div>

        <div class="row mb-5">
            {{-- Kredo cafe --}}
            <div class="col-4">
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Card Image with official mark --}}
                        {{-- <img src="{{ asset('images/Official Badge.png') }}" class="official" alt="official"> --}}
                        <a href="#" class="">
                            <img src="{{ asset('images/businessprofile/kredocafeimage.jpg') }}" class="card-img-top post-image" alt="image">
                        </a>
                    </div>
                    <div class="card-body content">  
                        <div class="row mb-3">
                            {{-- Category --}}
                            <div class="col-auto p-0">
                                <h5 class="card-subtitle">Category: <strong>Location</strong></h5>
                            </div>
                            
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                <h5 class="card-subtitle">2025/2/25</h5>
                            </div>
                        </div>                
            
                        
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">Hop Cafe</h4>
                                </a>
                            </div>
                        </div>
                       
                        {{-- Heart icon & Like function --}}
                        <div class="row align-items-center">
                            <div class="col-1 ms-2 p-0">
                                <form action="#" method="post">
                                    @csrf      
                                    <button type="submit" class="btn btn-sm shadow-none">
                                        <i class="fa-regular fa-heart pt-3"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 ms-1 px-2">
                                <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                                    10
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
                                <button class="dropdown-item text-dark">
                                    52
                                </button>
                            </div>
       
                            {{-- Number of viewers --}}
                            <div class="col-1 ms-3 p-0">
                                <div>
                                    <i class="fa-solid fa-chart-simple"></i>
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
                                    Lorem ipsum dolor, sit amet 
                                </p>
                            </div>    
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                    {{-- status --}}
                        <div class="row ">
                            <div class="col p-0">
                                <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                                <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-outline-green fw-bold mb-2 w-100">HIDE</a>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            
            {{-- Kredo hotel --}}
            <div class="col-4">
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Card Image with official mark --}}
                        {{-- <img src="{{ asset('images/Official Badge.png') }}" class="official" alt="official"> --}}
                        <a href="#" class="">
                            <img src="{{ asset('images/businessprofile/fireworks.jpg') }}" class="card-img-top post-image" alt="image">
                        </a>
                    </div>
                    <div class="card-body content">  
                        <div class="row mb-3">
                            {{-- Category --}}
                            <div class="col-auto p-0">
                                <h5 class="card-subtitle">Category: <strong>Event</strong></h5>
                            </div>
                            
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                <h5 class="card-subtitle">2025/2/25</h5>
                            </div>
                        </div>                
            
                        
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">Sumida River Fireworks Festival</h4>
                                </a>
                            </div>
                        </div>
                       
                        {{-- Heart icon & Like function --}}
                        <div class="row align-items-center ">
                            <div class="col-1 ms-2 p-0">
                                <form action="#" method="post">
                                    @csrf      
                                    <button type="submit" class="btn btn-sm shadow-none">
                                        <i class="fa-regular fa-heart pt-3"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 ms-1 px-2">
                                <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                                    10
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
                                <button class="dropdown-item text-dark">
                                    52
                                </button>
                            </div>
            
                            {{-- Number of viewers --}}
                            <div class="col-1 ms-3 p-0">
                                <div>
                                    <i class="fa-solid fa-chart-simple"></i>
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
                                    The Sumida River Fireworks Festival is one of Tokyo’s most spectacular and historic summer events. Held annually on the last Saturday of July, this breathtaking fireworks display lights up the night sky along the Sumida River, attracting over a million spectators.
                                </p>
                            </div>    
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                    {{-- status --}}
                        <div class="row">
                            <div class="col p-0">
                                <p>Status: <i class="fa-solid fa-circle text-danger"></i> Invisible</p>
                                <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-red mb-2 w-100">UNHIDE</a>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>

           
            {{-- Kredo Pub--}}
            <div class="col-4">
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Card Image with official mark --}}
                        <img src="{{ asset('images/logo/OfficialBadge.png') }}" class="official" alt="official">
                        <a href="#" class="">
                            <img src="{{ asset('images/businessprofile/kredopubimage.jpg') }}" class="card-img-top post-image" alt="image">
                        </a>
                    </div>
                    <div class="card-body content"> 
                        <div class="row mb-3">
                            {{-- Category --}}
                            <div class="col-auto p-0">
                                <h5 class="card-subtitle">Category: <strong>Location</strong></h5>
                            </div>
                            
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                <h5 class="card-subtitle">2025/2/25</h5>
                            </div>
                        </div>                
            
                        
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">Hop Pub</h4>
                                </a>
                            </div>
                        </div>
                       
                        {{-- Heart icon & Like function --}}
                        <div class="row align-items-center ">
                            <div class="col-1 ms-2 p-0">
                                <form action="#" method="post">
                                    @csrf      
                                    <button type="submit" class="btn btn-sm shadow-none">
                                        <i class="fa-regular fa-heart pt-3"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 ms-1 px-2">
                                <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                                    10
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
                                <button class="dropdown-item text-dark">
                                    52
                                </button>
                            </div>
            
                            {{-- Number of viewers --}}
                            <div class="col-1 ms-3 p-0">
                                <div>
                                    <i class="fa-solid fa-chart-simple"></i>
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
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime facere, quisquam adipisci saepe cupiditate reprehenderit laborum consequatur incidunt necessitatibus temporibus? Suscipit, quos! Ipsam, qui veniam nemo debitis harum dolore voluptate fugit atque eius odit vero quibusdam quasi excepturi ipsum vel maxime nihil? Laudantium nisi dolore, alias aut hic consectetur itaque.
                                </p>
                            </div>    
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        {{-- status --}}
                        <div class="row ">
                            <div class="col p-0">
                                <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                                <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-outline-green fw-bold mb-2 w-100">HIDE</a>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>

      
        </div>
    </div>

    {{-- Promotions --}}
    <div class="col-8 mb-5">
        <div class="row">
            <div class="col">
                <h3>Promotions</h3>
            </div>
            @if($user->id == Auth::user()->id)
                <div class="col-2">
                    <a href="{{ route('promotion.create') }}" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
                </div>
            @endif
        </div>
        {{-- forelse --}}
        <div class="row mb-1">
            @forelse($all_promotions as $promotion)
            <div class="col-4"> 
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Image --}}                         
                        <a href="{{ route('promotion.show', $promotion->id)}}" class="">
                            <img src="{{ $promotion->photo }}" class="card-img-top post-image" alt="image">
                        </a>                       
                    </div>
                    <div class="card-body pt-0">            
                        <div class="row mb-2">
                            {{-- Related Business --}}
                            <div class="col-auto p-0">
                                <h5 class="card-subtitle">{{ $promotion->business->name }}</h5>
                            </div>
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                <h5 class="card-subtitle"><span>{{date('D, M d Y', strtotime($promotion->created_at))}}</span></h5>
                            </div>
                        </div>
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">{{$promotion->title}}</h4>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col p-0">                               
                                {{-- promotion period --}}
                                @if($promotion->promotion_start && $promotion->promotion_end)
                                <h6 class="fw-bold">{{date('M d Y', strtotime($promotion->promotion_start))}} ~ {{date('M d Y', strtotime($promotion->promotion_end))}}</h6>
                                {{-- @else
                                <p>Day: -- --</p> --}}
                                @endif
                            </div>
                        </div>
                            {{-- introduction --}}
                        <div class="row">
                            <div class="col p-0">
                                <p class="card_description">
                                    {{ $promotion->introduction }}
                                </p>
                            </div>    
                        </div>  
                    </div>

                @if($user->id == Auth::user()->id)
                    <div class="card-footer bg-white">
                        {{-- status --}}
                            <div class="row ">
                                <div class="col p-0">
                                    {{-- visibility --}}
                                    @if($promotion->trashed())
                                        Status: <i class="fa-solid fa-circle color-red"></i> Hidden
                                    @else
                                        Status: <i class="fa-solid fa-circle color-green"></i> Visible
                                    @endif

                                    {{-- display --}}
                                    @if($promotion->display_start && $promotion->display_end)
                                    <p>Display period: {{date('M d Y', strtotime($promotion->display_start))}} ~ {{date('M d Y', strtotime($promotion->display_end))}}</p>
                                    @else
                                    <p>Display period: Not defined.</p>
                                    @endif
                                </div>    
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ route('promotion.edit', $promotion->id) }}" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                                </div>
                                <div class="col-6">
                                    @if($promotion->trashed())
                                    {{-- activate --}}
                                        <button class="btn btn-outline-green w-100" data-bs-toggle="modal" data-bs-target="#activate-promotion{{$promotion->id}}">
                                            UNHIDE
                                        </button>
                                    @else
                                        <button class="btn btn-red w-100" data-bs-toggle="modal" data-bs-target="#deactivate-promotion{{ $promotion->id }}">
                                            HIDE
                                        </button>
                                    @endif
                                    @include('businessusers.posts.promotions.modals.hide_unhide')
                                </div>

                            </div>
                    </div>  
                @endif
                </div>
            </div>
            @empty
                <h4 class="h4 text-center text-secondary">No Promotions yet.</h4>
            @endforelse 
        </div>
        <div class="d-flex justify-content-end">
        {{ $all_promotions->links() }}
        </div>
    </div>

    {{-- Model Quests --}}
    <div class="col-8 mb-3">
        <div class="row">
            <div class="col">
                <h3>Model Quests</h3>
            </div>
            @if($user->id == Auth::user()->id)
            <div class="col-2">
                <a href="#" class="btn btn-sm btn-navy text-white mb-2 w-100"><i class="fa-solid fa-plus"></i> ADD</a>
            </div>
            @endif
        </div>

        <div class="row mb-5">
            {{-- Festival --}}
            <div class="col-4">
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Card Image with official mark --}}
                        {{-- <img src="{{ asset('images/logo/OfficialBadge.png') }}" class="official" alt="official"> --}}
                        <a href="#" class="">
                            <img src="{{ asset('images/businessprofile/excursion.jpg') }}" class="card-img-top post-image" alt="image">
                        </a>
                    </div>
                    <div class="card-body ">             
                        <div class="row mb-3">
                            {{-- Category --}}
                            {{-- <div class="col-auto p-0">
                                <h5 class="card-subtitle">Category: <strong>Location</strong></h5>
                            </div> --}}
                            
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                <h5 class="card-subtitle">2025/2/25</h5>
                            </div>
                        </div>                
            
                        
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">Lunch at garden</h4>
                                </a>
                            </div>
                        </div>
                        
                        {{-- Heart icon & Like function --}}
                        <div class="row align-items-center ">
                            <div class="col-1 ms-2 p-0">
                                <form action="#" method="post">
                                    @csrf      
                                    <button type="submit" class="btn btn-sm shadow-none">
                                        <i class="fa-regular fa-heart pt-3"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 ms-1 px-2">
                                <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                                    10
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
                                <button class="dropdown-item text-dark">
                                    52
                                </button>
                            </div>
            
                            {{-- Number of viewers --}}
                            <div class="col-1 ms-3 p-0">
                                <div>
                                    <i class="fa-solid fa-chart-simple"></i>
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
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime facere, quisquam adipisci saepe cupiditate reprehenderit laborum consequatur incidunt necessitatibus temporibus? Suscipit, quos! Ipsam, qui veniam nemo debitis harum dolore voluptate fugit atque eius odit vero quibusdam quasi excepturi ipsum vel maxime nihil? Laudantium nisi dolore, alias aut hic consectetur itaque.
                                </p>
                            </div>    
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                    {{-- status --}}
                        <div class="row ">
                            <div class="col p-0">
                                <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                                <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-outline-green fw-bold mb-2 w-100">HIDE</a>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
            
            {{-- Seashore --}}
            <div class="col-4">
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Card Image with official mark --}}
                        {{-- <img src="{{ asset('images/logo/OfficialBadge.png') }}" class="official" alt="official"> --}}
                        <a href="#" class="">
                            <img src="{{ asset('images/businessprofile/seashore.jpg') }}" class="card-img-top post-image" alt="image">
                        </a>
                    </div>
                    <div class="card-body ">              
                        <div class="row mb-3">
                            {{-- Category --}}
                            {{-- <div class="col-auto p-0">
                                <h5 class="card-subtitle">Category: <strong>Location</strong></h5>
                            </div> --}}
                            
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                <h5 class="card-subtitle">2025/2/25</h5>
                            </div>
                        </div>                
            
                        
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">Seashore picnic</h4>
                                </a>
                            </div>
                        </div>
                        
                        {{-- Heart icon & Like function --}}
                        <div class="row align-items-center ">
                            <div class="col-1 ms-2 p-0">
                                <form action="#" method="post">
                                    @csrf      
                                    <button type="submit" class="btn btn-sm shadow-none">
                                        <i class="fa-regular fa-heart pt-3"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 ms-1 px-2">
                                <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                                    18
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
                                <button class="dropdown-item text-dark">
                                    52
                                </button>
                            </div>
            
                            {{-- Number of viewers --}}
                            <div class="col-1 ms-3 p-0">
                                <div>
                                    <i class="fa-solid fa-chart-simple"></i>
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
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime facere, quisquam adipisci saepe cupiditate reprehenderit laborum consequatur incidunt necessitatibus temporibus? Suscipit, quos! Ipsam, qui veniam nemo debitis harum dolore voluptate fugit atque eius odit vero quibusdam quasi excepturi ipsum vel maxime nihil? Laudantium nisi dolore, alias aut hic consectetur itaque.
                                </p>
                            </div>    
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                    {{-- status --}}
                    <div class="row">
                        <div class="col p-0">
                            <p>Status: <i class="fa-solid fa-circle text-danger"></i> Invisible</p>
                            <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
                        </div>    
                    </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-red mb-2 w-100">UNHIDE</a>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>

            
            {{-- Bird watching--}}
            <div class="col-4">
                <div class="card p-3">
                    <div class="card-header border-0 bg-light p-0 overflow-hidden">
                        {{-- Card Image with official mark --}}
                        {{-- <img src="{{ asset('images/logo/OfficialBadge.png') }}" class="official" alt="official"> --}}
                        <a href="#" class="">
                            <img src="{{ asset('images/businessprofile/birdwatching.jpg') }}" class="card-img-top post-image" alt="image">
                        </a>
                    </div>
                    <div class="card-body ">             
                        <div class="row mb-3">
                            {{-- Category --}}
                            {{-- <div class="col-auto p-0">
                                <h5 class="card-subtitle">Category: <strong>Location</strong></h5>
                            </div> --}}
                            
                            {{-- Postdate --}}
                            <div class="col-auto pe-0 ms-auto">
                                <h5 class="card-subtitle">2025/2/25</h5>
                            </div>
                        </div>                
            
                        
                        {{-- Title --}}
                        <div class="row">
                            <div class="col p-0">
                                <a href="#" class="text-decoration-none">
                                    <h4 class="card-title text-dark fw-bold">Bird watching at forest</h4>
                                </a>
                            </div>
                        </div>
                        
                        {{-- Heart icon & Like function --}}
                        <div class="row align-items-center ">
                            <div class="col-1 ms-2 p-0">
                                <form action="#" method="post">
                                    @csrf      
                                    <button type="submit" class="btn btn-sm shadow-none">
                                        <i class="fa-regular fa-heart pt-3"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="col-2 ms-1 px-2">
                                <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                                    10
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
                                <button class="dropdown-item text-dark">
                                    52
                                </button>
                            </div>
            
                            {{-- Number of viewers --}}
                            <div class="col-1 ms-3 p-0">
                                <div>
                                    <i class="fa-solid fa-chart-simple"></i>
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
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime facere, quisquam adipisci saepe cupiditate reprehenderit laborum consequatur incidunt necessitatibus temporibus? Suscipit, quos! Ipsam, qui veniam nemo debitis harum dolore voluptate fugit atque eius odit vero quibusdam quasi excepturi ipsum vel maxime nihil? Laudantium nisi dolore, alias aut hic consectetur itaque.
                                </p>
                            </div>    
                        </div>
                    </div>

                    <div class="card-footer bg-white">
                        {{-- status --}}
                        <div class="row ">
                            <div class="col p-0">
                                <p>Status: <i class="fa-solid fa-circle text-success"></i> Visible</p>
                                <p>Display period: Mar 5 2025 ~ Apr 26/2025</p>
                            </div>    
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-green fw-bold mb-2 w-100">EDIT</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-sm btn-outline-green fw-bold mb-2 w-100">HIDE</a>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>

        
        </div>
    </div>
</div>
</div>
@endsection
