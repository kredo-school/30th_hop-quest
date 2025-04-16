<div class="bg-blue">
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
            </div>
        </div>
    </div>        
</div>
@endsection