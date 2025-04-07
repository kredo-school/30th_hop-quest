<div class="bg-blue">
<<<<<<< HEAD
@extends('layouts.app')

@section('title', 'Review')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
    <div class="pb-5 row justify-content-center mt-4 pt-5">
        <div class="col-8">
            <div class="table-container">
                <table class="custom-table text-secondary mb-3">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="table-from-a ps-2">From</th>
                            <th class="table-rating-a text-center">Rating</th>
                            <th class="table-likes-a text-center">Likes</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr>
                            <td class="ps-2"><a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->user->name }}</a></td>
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
                        </tr>
                    </tbody>
                </table> 
                <table class="custom-table text-secondary mb-3">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="table-spot-a ps-2">Spot</th>
                            <th class="table-time-a text-center">Posted at</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr>
                            <td class="ps-2"><a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->business->name }}</a></td>
                            <td class="text-center">{{ $business_comment->created_at }}</td>
                        </tr>

                    </tbody>
                </table> 
                <table class="custom-table text-secondary">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="table-comment-a ps-2">Comments</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        <tr>
                            <td class=" ps-2"><a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->content }}</a></td> 
                        </tr>
                    </tbody>
                </table> 

        </div>
        <div class="row mt-5">       
            <div class="col align-center mb-0">
                <a href="{{ route('profile.allreviews', Auth::user()->id)}}">
                    <button class="btn btn-green text-uppercase w-25 position-absolute start-50 translate-middle mt-1">Back to all Reviews</button>
                </a>
=======
    @extends('layouts.app')
    
    @section('title', 'Review')
    
    @section('css')
        <link rel="stylesheet" href="{{ asset('css/review.css') }}">
    @endsection
    
    @section('content')
        <div class="pb-5 row justify-content-center mt-4 pt-5">
            <div class="col-8">
                <div class="row mb-3">
                    <div class="col-8">
                        <div class="card border-0">
                            <div class="card-header border-none bg-navy-thead text-white">
                                FROM
                            </div>
                            <div class="card-body">
                                <a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary border-none ">{{ $business_comment->user->name }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card border-0">
                            <div class="card-header border-none bg-navy-thead text-white text-center">
                                RATING
                            </div>
                            <div class="card-body text-center">
                                @for($i=1; $i <= $business_comment->rating; $i++)
                                    <i class="fa-solid fa-star color-yellow"></i>
                                @endfor
                                @for($i=1; $i <= 5 - $business_comment->rating; $i++)
                                    <i class="fa-regular fa-star color-navy"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="card border-0">
                            <div class="card-header border-none bg-navy-thead text-white text-center">
                                LIKES
                            </div>
                            <div class="card-body text-center">
                                @if($business_comment->BusinessCommentLikes->count() == 0)
                                    <p class="my-auto"><i class="fa-regular fa-heart me-2 align-middle"></i>{{$business_comment->BusinessCommentLikes->count()}}</p>
                                @else
                                    <p class="my-auto"><i class="fa-solid fa-heart color-red me-2 align-middle"></i>{{$business_comment->BusinessCommentLikes->count()}}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-8">
                        <div class="card border-0">
                            <div class="card-header border-none bg-navy-thead text-white ">
                                SPOT
                            </div>
                            <div class="card-body">
                                <a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->business->name }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="card border-0">
                            <div class="card-header border-none bg-navy-thead text-white">
                                POSTED AT
                            </div>
                            <div class="card-body">
                                {{ $business_comment->created_at }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card border-0">
                            <div class="card-header border-none bg-navy-thead text-white">
                                COMMENTS
                            </div>
                            <div class="card-body">
                                <a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->content }}</a>
                            </div>
                        </div>
                    </div>
                </div>
>>>>>>> main
            </div>
            <div class="row mt-5">       
                <div class="col align-center mb-0">
                    <a href="{{ route('profile.allreviews', Auth::user()->id)}}">
                        <button class="btn btn-green text-uppercase w-25 position-absolute start-50 translate-middle mt-1">Back to all Reviews</button>
                    </a>
                </div>
            </div>
        </div>        
    </div>
    @endsection