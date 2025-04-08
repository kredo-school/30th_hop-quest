<div class="posts-section p-4 bg-white rounded">
    <h4 class="fw-bold text-center mb-4">Liked Quests (view tourism log)</h4>
    <div class="container">
        @php
            $quests = $user['likedQuests'] ?? [];
            $emptySlots = 3 - (count($quests) % 3);
            $emptySlots = $emptySlots === 3 ? 0 : $emptySlots;
        @endphp

        @if (count($quests) > 0)
            <div class="row justify-content-center">
                @foreach ($quests as $quest)
                    <div class="col-md-4 mb-4 d-flex justify-content-center">
                        <div class="card shadow-sm" style="width: 18rem;">
                            <img src="{{ $quest['image'] }}" class="card-img-top" alt="Quest Image">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $quest['title'] }}</h5>
                                <p class="card-text small">{{ $quest['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                @for ($i = 0; $i < $emptySlots; $i++)
                    <div class="col-md-4 mb-4 d-flex justify-content-center">
                        <div style="width: 18rem;"></div>
                    </div>
                @endfor
            </div>
        @else
            <p class="text-muted text-center">No liked quests.</p>
        @endif
    </div>
</div>
