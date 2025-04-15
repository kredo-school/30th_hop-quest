<div class="row align-items-center text-white text-center mt-5 pt-5">

    <div class="col-md-2 avatar-container d-flex justify-content-center mt-4 pt-4">
        <img src="{{ $user->avatar ?? asset('images/profiles/avatar.jpg') }}" alt="Avatar"
            class="rounded-circle border border-white shadow" width="150" height="150" style="object-fit: cover;">
    </div>
    <div class="col-md-4 mt-3 text-start">
        <h4 class="username">{{ $user['name'] }}</h4>
    </div>
    <div class="col-md-3 mt-4 text-center">
        <a href="{{ route('myprofile.edit', $user['id']) }}"
            class="btn btn-outline-danger bg-white rounded fw-bold fs-5 w-75">EDIT</a>
    </div>
    <div class="col-md-3 mt-4 text-center">
        <button class="btn btn-danger rounded fw-bold fs-5 w-75" data-bs-toggle="modal"
            data-bs-target="#delete-account-modal">
            DELETE
        </button>
    </div>
    @include('tourists.profiles.modals.delete_account_modal', ['user' => $user])
</div>

<!-- Stats & Social -->
<div class="row mt-3 text-white align-items-center px-3">
    <div class="user-stats col-md-6 d-flex justify-content-center">
        <span class="me-4"><strong>{{ count($user['myQuests'] ?? []) + count($user['mySpots'] ?? []) }}</strong>
            Posts</span>
        <span class="me-4"><strong>{{ count($user['followers'] ?? []) }}</strong> Followers</span>
        <span><strong>{{ count($user['following'] ?? []) }}</strong> Following</span>
    </div>

    <div class="col-md-6 d-flex justify-content-end social-icons mb-3">
        @foreach (['instagram', 'facebook', 'x', 'tiktok'] as $social)
            @if (!empty($user[$social]))
                <a href="{{ $user[$social] }}" class="social-icon me-3">
                    <i class="fa-brands fa-{{ $social == 'x' ? 'x-twitter' : $social }} fa-2x text-white"></i>
                </a>
            @endif
        @endforeach
    </div>
</div>


<!-- Bio -->
<div class="mt-4 text-white">
    <p>{{ $user['introduction'] }}</p>
</div>
