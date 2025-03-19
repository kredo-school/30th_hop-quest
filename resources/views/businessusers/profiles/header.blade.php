<link rel="stylesheet" href="{{asset('css/style.css')}}"> 
<!-- Header image -->
    <div class="row">
        <div class="mb-3 px-0 pt-3">
            @if($user->header)
                <img src="{{$user->header}}" alt="" class="header-image">
            @else
                <img src="{{ asset('images/logo/header_logo.jpg') }}" alt="header_logo" class="header-image">
            @endif
        </div>
    </div> 
{{-- User information --}}
<div class="row justify-content-center mt-0">        
    <div class="col-8">
        <div class="profile-header position-relative"> 
            <div class="row">
                <!-- Avatar image -->
                <div class="col-auto profile-image">
                    @if($user->avatar)
                        <img src="{{$user->avatar}}" alt="" class="rounded-circle avatar-xl">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary icon-xl d-block text-center"></i>
                    @endif
                </div>
                
                <!-- Username -->
                <div class="col">
                    <div class="row">
                        <div class="col-auto">
                            <h3 class="mb-1 text-truncate">{{ $user->name }}</h3>
                        </div>
                        <div class="col-1 pb-2 p-1">
                            @if($user->official_certification == 1)
                            <img src="{{ asset('images/logo/official_personal.png')}}" class="official-personal d-inline ms-0 h2" alt="official-personal"> 
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
                            <a href="{{ route('profile.posts', $user->id) }}" class="text-decoration-none text-dark fw-bold">3 posts</a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('profile.followers') }}" class="text-decoration-none text-dark fw-bold">5 followers</a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('profile.reviews')}}" class="text-decoration-none text-dark fw-bold">7 reviews</a>
                        </div>

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




