<div class="comments-section p-4 bg-white rounded">
    <h4 class="fw-bold text-center mb-4">Comments</h4>

    @if (!empty($user['comments']))
        <ul class="list-group">
            @foreach ($user['comments'] as $comment)
                <li class="list-group-item mb-3">
                    {{-- Header: icon + title + date --}}
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="text-dark">
                            <i class="fa-regular fa-circle-left me-1"></i>
                            <span class="text-muted">to :</span>
                            <span class="fw-semibold">{{ $comment['title'] ?? 'No title' }}</span>
                        </div>
                        <small class="text-muted">{{ $comment['created_at'] ?? 'Date unknown' }}</small>
                    </div>

                    {{-- Divider line --}}
                    <hr class="my-2 text-muted">

                    {{-- Comment text --}}
                    <p class="fw-bold mb-2">{{ $comment['text'] }}</p>

                    {{-- Likes --}}
                    <div class="text-end align-items-center ms-1 pe-5 text-muted">
                        <i class="fa-solid fa-heart me-1"></i>
                        <span>{{ $comment['likes'] ?? 0 }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted text-center">No comments available.</p>
    @endif
</div>
