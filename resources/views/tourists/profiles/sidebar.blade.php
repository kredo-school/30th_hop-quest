<div class="sidebar">
    <ul class="nav flex-column">
        {{-- Posts (default) --}}
        <li class="{{ $section === null ? 'active-item' : '' }}">
            <a href="{{ route('profile.header', ['id' => Auth::id()]) }}">Posts</a>
        </li>

        {{-- Liked Section --}}
        <li class="nav-title">Liked</li>
        <ul class="nav flex-column sub-links">
            <li class="{{ $section === 'liked_quests' ? 'active-item' : '' }}">
                <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'liked_quests']) }}">▶︎Quests</a>
            </li>
            <li class="{{ $section === 'liked_spots' ? 'active-item' : '' }}">
                <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'liked_spots']) }}">▶︎Spots</a>
            </li>
            <li class="{{ $section === 'liked_businesses' ? 'active-item' : '' }}">
                <a
                    href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'liked_businesses']) }}">▶︎Business</a>
            </li>
        </ul>

        {{-- Followers --}}
        <li class="{{ $section === 'followers' ? 'active-item' : '' }}">
            <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'followers']) }}">Followers</a>
        </li>

        {{-- Following --}}
        <li class="{{ $section === 'follows' ? 'active-item' : '' }}">
            <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'follows']) }}">Following</a>
        </li>

        {{-- Comments --}}
        <li class="{{ $section === 'comments' ? 'active-item' : '' }}">
            <a href="{{ route('profile.header', ['id' => Auth::id(), 'section' => 'comments']) }}">Comments</a>
        </li>
    </ul>
</div>
