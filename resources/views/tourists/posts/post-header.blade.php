@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
@endsection

<div class="mt-4 row justify-content-center">
    <div class="col-8">
        <div class="row">
            <div class="col justify-content-center">
                <ul class="navbar-nav d-flex flex-row gap-3 me-auto h5">
                    <li class="nav-item">
                        <a href="{{ route('posts.followings') }}" class="nav-link {{ request()->is('tourist/posts/followings*') ? 'active' : '' }}">Followings'</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('posts.quests') }}" class="nav-link {{ request()->is('tourist/posts/quests*') ? 'active' : '' }}" >Quests</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('posts.spots') }}" class="nav-link {{ request()->is('tourist/posts/spots*') ? 'active' : '' }}">Spots</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('posts.locations') }}" class="nav-link {{ request()->is('tourist/posts/locations*') ? 'active' : '' }}">Locations</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('posts.events') }}" class="nav-link {{ request()->is('tourist/posts/events*') ? 'active' : '' }}">Events</a>
                    </li>
                </ul>
            </div>       
            <div class="col-2 align-self-end dropdown">
                <select name="sorting" id="sorting" class="form-control small">
                    <option value="" >Sorting</option>
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
</div>  
<hr>