<ul class="nav flex-column">
    {{-- Posts (default) --}}
    <li class="{{ request('tab') == null ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['id' => Auth::id()]) }}">Posts</a>
    </li>

    {{-- Liked Section --}}
    <li class="nav-title">Liked</li>
    <ul class="nav flex-column sub-links">
        <li class="{{ request('tab') == 'quests' ? 'active-item' : '' }}">
            <a href="{{ route('myprofile.show', ['id' => Auth::id(), 'tab' => 'quests']) }}">▶︎Quests</a>
        </li>
        <li class="{{ request('tab') == 'spots' ? 'active-item' : '' }}">
            <a href="{{ route('myprofile.show', ['id' => Auth::id(), 'tab' => 'spots']) }}">▶︎Spots</a>
        </li>
        <li class="{{ request('tab') == 'businesses' ? 'active-item' : '' }}">
            <a href="{{ route('myprofile.show', ['id' => Auth::id(), 'tab' => 'businesses']) }}">▶︎Business</a>
        </li>
    </ul>

    {{-- Followers --}}
    <li class="{{ request('tab') == 'followers' ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['id' => Auth::id(), 'tab' => 'followers']) }}">Followers</a>
    </li>

    {{-- Following --}}
    <li class="{{ request('tab') == 'following' ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['id' => Auth::id(), 'tab' => 'following']) }}">Following</a>
    </li>

    {{-- Comments --}}
    <li class="{{ request('tab') == 'comments' ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['id' => Auth::id(), 'tab' => 'comments']) }}">Comments</a>
    </li>

    {{-- Reviews --}}
    <li class="{{ request('tab') == 'reviews' ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['id' => Auth::id(), 'tab' => 'reviews']) }}">Review</a>
    </li>
</ul>
