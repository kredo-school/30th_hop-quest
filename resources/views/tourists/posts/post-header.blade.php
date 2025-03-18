@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
@endsection

<main></main>
<div class="row justify-content-center tag-category">
    <div class="col-auto">
        <a href="{{ route('posts.followings') }}" class="text-decoration-none text-dark" data-category="followings">
            <h1 class="poppins-semibold {{ request()->is('tourist/posts/followings*') ? 'active' : '' }}">
                <i class="fa-solid fa-bookmark"></i> Followings'
            </h1>
        </a>
    </div>
    <div class="col-auto ms-5">
        <a href="{{ route('posts.spots') }}" class="text-decoration-none text-dark" data-category="spot">
            <h1 class="poppins-semibold {{ request()->is('tourist/posts/spots*') ? 'active' : '' }}">
                <i class="fa-solid fa-location-dot"></i> Spots
            </h1>
        </a>
    </div>
    <div class="col-auto ms-5">
        <a href="{{ route('posts.quests') }}" class="text-decoration-none text-dark" data-category="quest">
            <h1 class="poppins-semibold {{ request()->is('tourist/posts/quest*') ? 'active' : '' }}">
                <i class="fa-solid fa-plane fa-rotate-by" style="--fa-rotate-angle: -30deg;"></i> Quests
            </h1>
        </a>
    </div>
    <div class="col-auto ms-5">
        <a href="{{ route('posts.locations') }}" class="text-decoration-none text-dark" data-category="location">
            <h1 class="poppins-semibold {{ request()->is('tourist/posts/locations*') ? 'active' : '' }}">
                <i class="fa-solid fa-map"></i> Locations
            </h1>
        </a>
    </div>
    <div class="col-auto ms-5">
        <a href="{{ route('posts.events') }}" class="text-decoration-none text-dark" data-category="event">
            <h1 class="poppins-semibold {{ request()->is('tourist/posts/events*') ? 'active' : '' }}">
                <i class="fa-solid fa-calendar"></i> Events
            </h1>
        </a>
    </div>
</div>
<hr>
<div class="mt-3 row justify-content-center">
    <div class="col-8">
        <div class="row">     
            <div class="col-2 ms-auto dropdown">
                <select name="sorting" id="sorting" class="form-control small">
                    <option value="" disabled selected>Sorting</option>
                    <option value="" >Number of viewers</option>
                    <option value="" >Number of likes</option>
                    <option value="" >Number of comments</option>
                    <option value="" >From latest</option>
                    <option value="" >From oldest</option>
                </select>
                {{-- <button class="btn btn-light dropdown-toggle ms-auto" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Sorting
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><button class="dropdown-item" type="bottun">Number of viewers</a></bottun>
                    <li><button class="dropdown-item" type="bottun">Number of likes</a></bottun>
                    <li><button class="dropdown-item" type="bottun">Number of comments</a></bottun>
                    <li><button class="dropdown-item" type="bottun">Latest</a></bottun>
                </ul> --}}
            </div>  
        </div>    
    </div>
</main>
</div>  
