<div class="bg-blue">
    @extends('layouts.app')

    @section('title', 'Posts')
    
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/review.css')}}">
        {{-- <link rel="stylesheet" href="{{asset('css/style.css')}}"> 
        <link rel="stylesheet" href="{{asset('css/profiles/profile.css')}}">  --}}
    @endsection
    
    @section('content')
        <div class="row justify-content-center mt-5 pb-5 ">
            <div class="col-8">
                <div class="row">
                    <h3 class="mb-3 poppins-regular">All Reviews</h3>
                </div>
                <div class="row">
                    <div class="table-container">
                        <table class="custom-table text-secondary mb-3">
                            <thead>
                                <tr class="text-uppercase">
                                    <th class="table-from ps-2">
                                        <form method="GET" action="{{ route('business.reviews.indexreview', Auth::user()->id) }}">
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
                                        <form method="GET" action="{{ route('business.reviews.indexreview', Auth::user()->id) }}">
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
                                    <th class="table-body ps-3">Comments</th>
                                    <th class="table-rating text-center">
                                        <form method="GET" action="{{ route('business.reviews.indexreview', Auth::user()->id) }}">
                                            <label for="min_rating" class=""></label>
                                            <select name="min_rating" onchange="this.form.submit()" class="bg-navy-thead mt-3 text-sm">
                                                <option value="">RATING</option>
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <option value="{{ $i }}">{{ $i }}⬆️</option>
                                                @endfor
                                            </select>
                                        </form>
                                    
                                    </th>
                                    <th class="table-likes text-center">Likes</th>
                                    <th class="table-time ps-3 text-center">
                                        <form method="GET" action="{{ route('business.reviews.all', Auth::id()) }}" >
                                            <label for="sort_date" class=""></label>
                                            <select name="sort_date" id="sort_date" onchange="this.form.submit()" class="bg-navy-thead mt-3 text-sm">
                                                <option value="" disabled selected>POSTED AT</option>
                                                <option value="latest" {{ request('sort_date') == 'latest' ? 'selected' : '' }}>FROM LATEST</option>
                                                <option value="oldest" {{ request('sort_date') == 'oldest' ? 'selected' : '' }}>FROM OLDEST</option>
                                            </select>
                                        
                                            {{-- 他のフィルター条件も維持したい場合 --}}
                                            @if (request('min_rating'))
                                                <input type="hidden" name="min_rating" value="{{ request('min_rating') }}">
                                            @endif
                                            @if (request('user_id'))
                                                <input type="hidden" name="user_id" value="{{ request('user_id') }}">
                                            @endif
                                            @if (request('business_id'))
                                                <input type="hidden" name="business_id" value="{{ request('business_id') }}">
                                            @endif
                                        </form>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="">
                                @forelse($business_comments as $business_comment)
                                    @if($business_comment->business->user->id == Auth::user()->id)
                                        <tr>
                                            <td class="ps-2"><a href="{{ route('business.reviews.show', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->user->name }}</a></td>
                                            <td><a href="{{ route('business.reviews.show', $business_comment->id) }}" class="text-decoration-none text-secondary ">{{ $business_comment->business->name }}</a></td>
                                            <td class="table-comment ps-3"><a href="{{ route('business.reviews.show', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->content }}</a></td> 
                                            <td class="text-center">
                                                @for($i=1; $i <= $business_comment->rating; $i++)
                                                <i class="fa-solid fa-star color-yellow"></i>
                                                @endfor
                                                @for($i=1; $i <= 5 - $business_comment->rating; $i++)
                                                <i class="fa-regular fa-star color-navy"></i>
                                                @endfor
                                            </td>
                                            <td class="text-center">
                                                @if($business_comment->BusinessCommentLikes->count() == 0)
                                                <p class="my-auto"><i class="fa-regular fa-heart me-2 align-middle"></i>{{$business_comment->BusinessCommentLikes->count()}}</p>
                                                @else
                                                <p class="my-auto"><i class="fa-solid fa-heart color-red me-2 align-middle"></i>{{$business_comment->BusinessCommentLikes->count()}}</p>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $business_comment->created_at }}</td>

                                    </tr>
                                @endif
                            @empty
                            @endforelse
                        </tbody>
                    </table> 
                    <div class="d-flex justify-content-end mb-5">
                        {{ $business_comments->links() }}
                    </div>
                </div>  
            </div>
            <div class="row pt-0">       
                <div class="col align-center mb-0">
                    <a href="{{route('profile.header', Auth::user()->id)}}">
                        <button class="btn btn-green text-uppercase w-25 position-absolute start-50 translate-middle mt-1">Back to Profile</button>
                    </a>
                </div>
            </div>
        </div>

    </div>        

</div>
@endsection

