<div class="followers-section p-4 bg-white rounded" style="max-width: 600px; margin: 0 auto;">
    <h3 class="poppins-bold text-center mb-4">Followers</h3>

    @foreach ($user['followers'] as $index => $follower)
        <div class="row d-flex justify-content-between align-items-center p-3 mb-3">
            <!-- Avatar -->
            <div class="col-md-2 d-flex align-items-center">
                <img src="{{ $follower['avatar'] }}" alt="{{ $follower['name'] }}" class="rounded-circle me-3"
                    style="width: 50px; height: 50px; object-fit: cover;">
            </div>
            <!-- Name -->
            <div class="col-md-4 text-center">
                <span class="fw-semibold">{{ $follower['name'] }}</span>
            </div>

            <!-- Follow Button -->
            <div class="col-md-6  text-end">
                @php
                    $isFollowing = $index < 2;
                @endphp
                @if ($isFollowing)
                    <button class="btn btn-outline-info btn-sm rounded-pill px-4">FOLLOWING</button>
                @else
                    <button class="btn btn-sm btn-info rounded-pill text-white px-4">FOLLOW</button>
                @endif
            </div>
        </div>
    @endforeach
</div>
