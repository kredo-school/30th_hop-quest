<div class="followers-section p-4 bg-white rounded" style="max-width: 600px; margin: 0 auto;">
    <h3 class="poppins-bold text-center mb-4">Following</h3>

    @if (!empty($user['following']))
        @foreach ($user['following'] as $following)
            <div class="row d-flex justify-content-between align-items-center p-3 mb-3">
                <!-- Avatar -->
                <div class="col-md-2 d-flex align-items-center">
                    <img src="{{ $following['avatar'] }}" alt="{{ $following['name'] }}" class="rounded-circle me-3"
                        style="width: 50px; height: 50px; object-fit: cover;">
                </div>

                <!-- Name -->
                <div class="col-md-6 text-start">
                    <span class="fw-semibold">{{ $following['name'] }}</span>
                </div>

                <!-- Unfollow Button (non-functional in this static version) -->
                <div class="col-md-4 text-end">
                    <button class="btn btn-outline-info btn-sm rounded-pill px-4">FOLLOWING</button>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-muted text-center">You are not following anyone.</p>
    @endif
</div>
