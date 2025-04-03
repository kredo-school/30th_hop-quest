<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Review Index')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')


<script>
    function toggleDropdown() {
        const dropdown = document.getElementById('spot-dropdown');
        dropdown.style.display = (dropdown.style.display === 'none' || dropdown.style.display === '') ? 'block' : 'none';
    }
</script>

    <div class="row justify-content-center mt-5 pb-5 ">
        <div class="col-8">
            <div class="row">
                <h4 class="mb-3 poppins-regular">Selected Reviews</h4>
            </div>
            <div class="row">
            <div class="table-container">
                <table class="custom-table text-secondary mb-3">
                    <thead >
                        <tr>
                            <th class="table-from ps-2">
                                <form method="GET" action="{{ route('profile.indexreview', Auth::user()->id) }}">
                                    <label for="user_id" class="text-white"></label>
                                    <select name="user_id" id="user_id" onchange="this.form.submit()" class="bg-navy-thead mt-3 text-sm">
                                        <option value="" class="text-white bg-navy" disabled selected>FROM</option>
                                        @foreach ($from_users as $user)
                                            @if ($user->id !== Auth::id())
                                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </form>
                            </th>
                            <th class="table-spot">
                                <form method="GET" action="{{ route('profile.indexreview', Auth::user()->id) }}">
                                    <label for="business_id" class="text-white"></label>
                                    <select name="business_id" id="business_id" onchange="this.form.submit()" class="bg-navy-thead mt-3 text-sm">
                                        <option value="" class="text-white bg-navy" disabled selected>SPOT</option>
                                        @foreach ($from_businesses as $business)
                                            @if ($business->user->id == Auth::id())
                                                <option value="{{ $business->id }}" class="" {{ request('business_id') == $business->id ? 'selected' : '' }}>
                                                    {{ $business->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </form>
                            </th>
                            <th class="table-body ps-3">COMMENTS</th>
                            <th class="table-rating text-center">
                                <form method="GET" action="{{ route('profile.indexreview', Auth::user()->id) }}">
                                    <label for="min_rating" class="text-xs text-gray-600 block mb-1"></label>
                                    <select name="min_rating" onchange="this.form.submit()" class="bg-navy-thead mt-3 text-sm">
                                        <option value="">RATING</option>
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}">{{ $i }}🔼</option>
                                        @endfor
                                    </select>
                                </form>
                            </th>
                            <th class="table-likes text-center">LIKES</th>
                            <th class="table-time text-center">POSTED AT</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse($reviews as $review)
                            @if($review->business->user->id == Auth::user()->id)
                                <tr>
                                    <td class="ps-2"><a href="{{ route('profile.review', $review->id) }}" class="text-decoration-none text-secondary">{{ $review->user->name }}</a></td>
                                    <td><a href="{{ route('profile.review', $review->id) }}" class="text-decoration-none text-secondary ">{{ $review->business->name }}</a></td>
                                    <td class="table-comment ps-3"><a href="{{ route('profile.review', $review->id) }}" class="text-decoration-none text-secondary">{{ $review->body }}</a></td> 
                                    <td class="text-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $review->rating)
                                                <i class="fa-solid fa-star color-yellow"></i>
                                            @else
                                                <i class="fa-regular fa-star color-navy"></i>
                                            @endif
                                        @endfor
                                    </td>
                                    <td class="text-center">
                                        @if($review->BusinessReviewLikes->count() == 0)
                                        <p class="my-auto"><i class="fa-regular fa-heart me-2 align-middle"></i>{{$review->BusinessReviewLikes->count()}}</p>
                                        @else
                                        <p class="my-auto"><i class="fa-solid fa-heart color-red me-2 align-middle"></i>{{$review->BusinessReviewLikes->count()}}</p>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $review->created_at }}</td>
                                    <td class="pe-2">
                                        {{-- delete --}}
                                        <button class="btn btn-sm btn-red " data-bs-toggle="modal" data-bs-target="#delete-review{{$review->id}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        @include('businessusers.reviews.modals.delete')
                                    </td>
                                </tr>
                            @endif
                        @empty
                        @endforelse
                    </tbody>
                </table> 
                <div class="d-flex justify-content-end mb-5">
                    {{ $reviews->appends(request()->query())->links() }}
                </div>
            </div>  
            </div>
            <div class="row mt-0">       
                <div class="col align-center mb-0">
                    <a href="{{ route('profile.allreviews', Auth::user()->id)}}">
                        <button class="btn btn-green text-uppercase w-25 position-absolute start-50 translate-middle mt-1">Back to all Reviews</button>
                    </a>
                </div>
            </div>
        </div>

    </div>        

</div>
@endsection