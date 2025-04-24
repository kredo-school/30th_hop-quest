<ul class="nav flex-column">
    <li class="{{ request('tab') == null ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['id' => Auth::id()]) }}">
    </li>

    <li class="nav-title">Liked</li>
    <ul class="nav flex-column sub-links">
        <li class="{{ request('tab') == 'quests' ? 'active-item' : '' }}">
            <a href="{{ route('myprofile.show', ['tab' => 'quests']) }}">▶︎Quests</a>
        </li>
        <li class="{{ request('tab') == 'spots' ? 'active-item' : '' }}">
            <a href="{{ route('myprofile.show', ['tab' => 'spots']) }}">▶︎Spots</a>
        </li>
        <li class="{{ request('tab') == 'businesses' ? 'active-item' : '' }}">
            <a href="{{ route('myprofile.show', ['tab' => 'businesses']) }}">▶︎Business</a>
        </li>
    </ul>

    <li class="{{ request('tab') == 'followers' ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['tab' => 'followers']) }}">Followers</a>
    </li>

    <li class="{{ request('tab') == 'following' ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['tab' => 'following']) }}">Following</a>
    </li>

    <li class="{{ request('tab') == 'comments' ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['tab' => 'comments']) }}">Comments</a>
    </li>

    <li class="{{ request('tab') == 'reviews' ? 'active-item' : '' }}">
        <a href="{{ route('myprofile.show', ['tab' => 'reviews']) }}">Review</a>
    </li>

</ul>
