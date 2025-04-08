<div class="reviews-section p-4 bg-white rounded">
    <h4 class="fw-bold text-center mb-4">Review</h4>

    @if (!empty($user['reviews']))
        <ul class="list-group">
            @foreach ($user['reviews'] as $review)
                <li class="list-group-item mb-3">
                    {{-- Header: icon + title + rating + date --}}
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="text-dark">
                            {{-- <i class="fa-solid fa-magnifying-glass"></i> --}}
                            <i class="fa-regular fa-comment-dots me-1"></i>
                            <span class="text-muted">to :</span>
                            <span class="fw-semibold">{{ $review['title'] ?? 'No title' }}</span>

                            {{-- Rating stars --}}
                            @php
                                $rating = $review['rating'] ?? 0;
                            @endphp
                            <span class="ms-2 text-warning">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($i < $rating)
                                        ★
                                    @else
                                        ☆
                                    @endif
                                @endfor
                            </span>
                        </div>
                        <small class="text-muted">{{ $review['created_at'] ?? 'Date unknown' }}</small>
                    </div>

                    <hr class="my-2 text-muted">

                    {{-- Review text --}}
                    <p class="fw-bold mb-2">{{ $review['text'] }}</p>

                    {{-- Likes --}}
                    <div class="text-end align-items-center ms-1 pe-5 text-muted">
                        <i class="fa-solid fa-heart me-1"></i>
                        <span>{{ $review['likes'] ?? 0 }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted text-center">No reviews available.</p>
    @endif
</div>
