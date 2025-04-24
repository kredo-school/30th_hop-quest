<ul class="nav flex-column">
    <li class="{{ request('tab') == null ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', $user->id) }}">Posts</a>
    </li>

    <li class="nav-title">Liked</li>
    <ul class="nav flex-column sub-links">
        <li class="{{ request('tab') == 'quests' ? 'active-item' : '' }}">
            {{-- <a href="{{ route('myprofile.show', ['tab' => 'quests']) }}">▶︎Quests</a> --}}           
            <a class="nav-link {{ $tab == 'quests' ? 'active-tab' : '' }}"
            href="{{ route('profile.header', ['id' => $user->id, 'section' => 'liked_quests']) }}" >
            ▶︎Quests
        </a>
        </li>
        
        <li class="{{ request('tab') == 'spots' ? 'active-item' : '' }}">
            {{-- <a href="{{ route('myprofile.show', ['tab' => 'quests']) }}">▶︎Quests</a> --}}           
            <a class="nav-link {{ $tab == 'spots' ? 'active-tab' : '' }}"
            href="{{ route('profile.header', ['id' => $user->id, 'section' => 'liked_spots']) }}" >
            ▶︎Spots
        </a>
        </li>

        <li class="{{ request('tab') == 'businesses' ? 'active-item' : '' }}">
            <a class="nav-link {{ $tab == 'businesses' ? 'active-tab' : '' }}"
            href="{{ route('profile.header', ['id' => $user->id, 'section' => 'liked_businesses']) }}" >
            ▶︎Business
        </li>
    </ul>

    <li class="{{ request('tab') == 'followers' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'followers']) }}" class="text-decoration-none">Followers</a>
    </li>

    <li class="{{ request('tab') == 'following' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'follows']) }}" class="text-decoration-none">Following</a>
    </li>

    <li class="{{ request('tab') == 'comments' ? 'active-item' : '' }}">
        <a href="{{ route('profile.header', ['id' => $user->id, 'section' => 'comments']) }}" class="text-decoration-none"><span class="fw-bold">Comments</a>
    </li>

</ul>
