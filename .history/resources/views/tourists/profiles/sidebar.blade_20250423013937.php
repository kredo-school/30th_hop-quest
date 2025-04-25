<ul class="nav flex-column">
    {{-- Posts (default) --}}
    <li class="{{ request('section') == null ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => Auth::id()]) }}">Posts</a>
    </li>

    <li class="nav-title">Liked</li>
    <ul class="nav flex-column sub-links">
        <li class="{{ request('section') == 'liked_quests' ? 'active-item' : '' }}">
            <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'liked_quests']) }}">▶︎Quests</a>
        </li>
        <li class="{{ request('section') == 'liked_spots' ? 'active-item' : '' }}">
            <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'liked_spots']) }}">▶︎Spots</a>
        </li>
        <li class="{{ request('section') == 'liked_businesses' ? 'active-item' : '' }}">
            <a
                href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'liked_businesses']) }}">▶︎Business</a>
        </li>
    </ul>

    <li class="{{ request('section') == 'followers' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'followers']) }}">Followers</a>
    </li>

    <li class="{{ request('section') == 'follows' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'follows']) }}">Following</a>
    </li>

    <li class="{{ request('section') == 'comments' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'comments']) }}">Comments</a>
    </li>

</ul>
