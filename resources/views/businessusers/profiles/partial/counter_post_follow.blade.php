{{-- items --}}
    <!--Post-->
    <div class="col-auto">
        @if($user->role_id == 1)                          
            @if($user->id == Auth::user()->id)
                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-white"><span class="fw-bold">{{$user->businessPromotions->count()+$user->businesses->count()+$user->quests->count()}}</span> {{$user->businessPromotions->count()+$user->businesses->count()+$user->quests->count()==1 ? 'post' : 'posts'}}</a>
            @elseif($user->id != Auth::user()->id)
                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-white"><span class="fw-bold">{{$user->businessPromotionsVisible->count()+$user->businessesVisible->count()+$user->questsVisible->count()}}</span> {{$user->businessPromotionsVisible->count()+$user->businessesVisible->count()+$user->questsVisible->count()==1 ? 'post' : 'posts'}}</a>
            @endif
        @else
            @if($user->id == Auth::user()->id)
                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->businessPromotions->count()+$user->businesses->count()+$user->quests->count()}}</span> {{$user->businessPromotions->count()+$user->businesses->count()+$user->quests->count()==1 ? 'post' : 'posts'}}</a>
            @elseif($user->id != Auth::user()->id)
                <a href="{{ route('profile.header', $user->id) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->businessPromotionsVisible->count()+$user->businessesVisible->count()+$user->questsVisible->count()}}</span> {{$user->businessPromotionsVisible->count()+$user->businessesVisible->count()+$user->questsVisible->count()==1 ? 'post' : 'posts'}}</a>
            @endif
        @endif
    </div>
    <!--Follower-->
    @if($user->role_id == 1)  
        <div class="col-auto">
            <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'followers']) }}" class="text-decoration-none text-white"><span class="fw-bold">{{$user->followers->count()}}</span> {{$user->followers->count()==1 ? 'follower' : 'followers'}}</a>
        </div>
        <div class="col-auto">
            <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'follows']) }}" class="text-decoration-none text-white"><span class="fw-bold">{{$user->follows->count()}}</span> following</a>
        </div>
    @else  
        <div class="col-auto">
            <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'followers']) }}" class="text-decoration-none text-dark"><span class="fw-bold">{{$user->followers->count()}}</span> {{$user->followers->count()==1 ? 'follower' : 'followers'}}</a>
        </div>
    @endif
    @if($user->id == Auth::user()->id && $user->role_id == 2)
        <div class="col-auto">
            @if($user->id == Auth::user()->id)                             
                <a href="{{ route('business.reviews.all', $user->id)}}" class="text-decoration-none text-dark"><span class="fw-bold">{{$business_comments->count()}}</span> {{$business_comments->count()==1 ? 'review' : 'reviews'}}</a>
            @endif
        </div>
    @endif

@if($user->role_id == 1)       
    {{-- SNS icons --}}
    <div class="col-auto ms-auto">
        @if($user->instagram)
            <a href="#" class="text-decoration-none">
            <i class="fa-brands fa-instagram text-white icon-md px-4"></i>
            </a>
        @endif
        @if($user->facebook)
            <a href="#" class="text-decoration-none">
            <i class="fa-brands fa-facebook text-white icon-md px-4"></i>
            </a>
        @endif
        @if($user->x)
            <a href="#" class="text-decoration-none">
            <i class="fa-brands fa-x-twitter text-white icon-md px-4"></i>
            </a>
        @endif
        @if($user->tiktok)
            <a href="#" class="text-decoration-none">
            <i class="fa-brands fa-tiktok text-white icon-md px-4"></i>
            </a>
        @endif
    </div>
@elseif($user->role_id == 2)
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
    @endif
