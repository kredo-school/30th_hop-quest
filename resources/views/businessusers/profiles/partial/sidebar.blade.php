<ul class="nav flex-column">
    <li class="{{ request('tab') === null && request('section') === null ? 'active-item' : '' }}">
        <a class="nav-link" href="{{ route('profile.header', $user->id) }}">Posts</a>
    </li>

    <li class="nav-title">Liked</li>
    <ul class="nav flex-column sub-links">
        <li class="{{ request('section') == 'liked_quests' ? 'active-item' : '' }}">
            <a class="nav-link" href="{{ route('profile.header', ['id' => $user->id, 'section' => 'liked_quests']) }}">
                ▶︎Quests
            </a>
        </li>
        <li class="{{ request('section') == 'liked_spots' ? 'active-item' : '' }}">
            <a class="nav-link" href="{{ route('profile.header', ['id' => $user->id, 'section' => 'liked_spots']) }}">
                ▶︎Spots
            </a>
        </li>
        <li class="{{ request('section') == 'liked_businesses' ? 'active-item' : '' }}">
            <a class="nav-link"
                href="{{ route('profile.header', ['id' => $user->id, 'section' => 'liked_businesses']) }}">
                ▶︎Business
            </a>
        </li>
    </ul>

    <li class="{{ request('section') == 'followers' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'followers']) }}"
            class="text-decoration-none">
            {{ $user->followers->count() == 1 ? 'follower' : 'followers' }}
        </a>
    </li>

    <li class="{{ request('section') == 'follows' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'follows']) }}"
            class="text-decoration-none">
            following
        </a>
    </li>

    <li class="{{ request('section') == 'comments' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'comments']) }}"
            class="text-decoration-none">
            {{ $user->businessComments->count() + $user->questComments->count() + $user->spotComments->count() == 1 ? 'comment' : 'comments' }}
        </a>
    </li>
</ul>
