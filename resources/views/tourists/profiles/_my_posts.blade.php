@php use Carbon\Carbon; @endphp

@if (!empty($user['myQuests']) || !empty($user['mySpots']))
    {{-- Quests Section --}}
    @if (!empty($user['myQuests']))
        <div class="posts-section p-4 bg-white rounded mb-5">
            <h4 class="fw-bold text-center mb-4">Quests (view tourism log)</h4>
            <div class="container">
                @php
                    $quests = $user['myQuests'];
                    $columns = 3;
                    $emptySlots = $columns - (count($quests) % $columns);
                    $emptySlots = $emptySlots === $columns ? 0 : $emptySlots;
                @endphp

                <div class="row justify-content-center">
                    @foreach ($quests as $quest)
                        <div class="col-md-4 mb-4 d-flex justify-content-center">
                            <div class="card shadow-sm" style="width: 18rem;">
                                <img src="{{ $quest->main_image }}" class="card-img-top" alt="Quest Image"
                                    style="height: 180px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                <div class="card-body text-center">
                                    <div class="d-flex justify-content-between mb-2 px-2">
                                        <span class="fw-bold text-start">{{ Str::limit($quest->title, 18) }}</span>
                                        <small
                                            class="text-muted">{{ $quest->start_date ? Carbon::parse($quest->start_date)->format('Y/m/d') : 'N/A' }}</small>
                                    </div>
                                    <div class="d-flex justify-content-between px-4 mt-2">
                                        <div>
                                            <i
                                                class="fa-regular fa-heart me-1"></i>{{ $quest->questLikes->count() ?? 0 }}
                                        </div>
                                        <div>
                                            <i
                                                class="fa-regular fa-comment me-1"></i>{{ $quest->questComments->count() ?? 0 }}
                                        </div>
                                        <div><i
                                                class="fa-solid fa-chart-column me-1"></i>{{ $quest->pageViews->count() ?? 0 }}
                                        </div>
                                    </div>


                                    {{-- Buttons for AuthUser only --}}
                                    @if (isset($isOwnProfile) && $isOwnProfile)
                                        <div class="d-flex justify-content-center gap-2 mt-3">
                                            <a href="{{ route('quests.edit', $quest->id) }}"
                                                class="btn btn-sm btn-info text-white">EDIT</a>
                                            <form method="POST"
                                                action="{{ route('quests.toggleVisibility', $quest->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                @if ($quest->is_public)
                                                    <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">HIDE</button>
                                                @else
                                                    <button type="submit"
                                                        class="btn btn-sm btn-success">UNHIDE</button>
                                                @endif
                                            </form>
                                        </div>
                                    @endif
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
            </div>
        </div>
    @endif

    {{-- Spots Section --}}
    @if (!empty($user['mySpots']))
        <div class="posts-section p-4 bg-white rounded">
            <h4 class="fw-bold text-center mb-4">Spots (view tourism log)</h4>
            <div class="container">
                @php
                    $spots = $user['mySpots'];
                    $columns = 3;
                    $emptySlots = $columns - (count($spots) % $columns);
                    $emptySlots = $emptySlots === $columns ? 0 : $emptySlots;
                @endphp

                <div class="row justify-content-center">
                    @foreach ($spots as $spot)
                        <div class="col-md-4 mb-4 d-flex justify-content-center">
                            <div class="card shadow-sm" style="width: 18rem;">
                                <img src="{{ $spot->main_image }}" class="card-img-top" alt="Spot Image"
                                    style="height: 180px; object-fit: cover; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                <div class="card-body text-center">
                                    <div class="d-flex justify-content-between mb-2 px-2">
                                        <span class="fw-bold text-start">{{ Str::limit($spot->title, 18) }}</span>
                                        <small
                                            class="text-muted">{{ $spot->created_at ? Carbon::parse($spot->created_at)->format('Y/m/d') : 'N/A' }}</small>
                                    </div>
                                    <div class="d-flex justify-content-between px-4 mt-2">
                                        <div><i
                                                class="fa-regular fa-heart me-1"></i>{{ $spot->spotLikes->count() ?? 0 }}
                                        </div>
                                        <div><i
                                                class="fa-regular fa-comment me-1"></i>{{ $spot->spotComments->count() ?? 0 }}
                                        </div>
                                        <div><i
                                                class="fa-solid fa-chart-column me-1"></i>{{ $spot->views->count() ?? 0 }}
                                        </div>
                                    </div>
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
            </div>
        </div>
    @endif
@else
    <p class="text-center text-muted">No posts available.</p>
@endif
