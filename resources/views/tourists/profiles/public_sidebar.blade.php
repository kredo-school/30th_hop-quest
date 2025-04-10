<div class="sidebar poppins-bold">
    <ul class="list-unstyled">
        <li class="mb-3 {{ request('tab') === 'posts' || request('tab') === null ? 'active-item' : '' }}">
            <a href="?tab=posts">Posts</a>
        </li>

        <li class="nav-title">Liked</li>
        <ul class="list-unstyled ms-3 mb-3 sub-links">
            <li class="{{ request('tab') === 'quests' ? 'active-item' : '' }}">
                <a href="?tab=quests">▶Quests</a>
            </li>
            <li class="{{ request('tab') === 'spots' ? 'active-item' : '' }}">
                <a href="?tab=spots">▶Spots</a>
            </li>
            <li class="{{ request('tab') === 'businesses' ? 'active-item' : '' }}">
                <a href="?tab=businesses">▶Business</a>
            </li>
        </ul>

        <li class="mb-3 {{ request('tab') === 'followers' ? 'active-item' : '' }}">
            <a href="?tab=followers">Followers</a>
        </li>
        <li class="mb-3 {{ request('tab') === 'following' ? 'active-item' : '' }}">
            <a href="?tab=following">Following</a>
        </li>
        <li class="mb-3 {{ request('tab') === 'comments' ? 'active-item' : '' }}">
            <a href="?tab=comments">Comments</a>
        </li>
        <li class="mb-3 {{ request('tab') === 'reviews' ? 'active-item' : '' }}">
            <a href="?tab=reviews">Review</a>
        </li>
    </ul>
</div>
