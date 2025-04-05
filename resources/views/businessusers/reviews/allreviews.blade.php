<div class="bg-blue">
@extends('layouts.app')

@section('title', 'All Reviews')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/review.css') }}">
@endsection

@section('content')
    <div class="row justify-content-center mt-5 pb-5 ">
        <div class="col-8">
            <div class="row">
                <h4 class="mb-3 poppins-regular">All Reviews</h4>
            </div>
            <div class="row">
            <div class="table-container">
                <table class="custom-table text-secondary">
                    <thead>
                        <tr class="text-uppercase">
                            <th class="table-from ps-2">From</th>
                            <th class="table-spot">Spot</th>
                            <th class="table-body">Comments</th>
                            <th class="table-rating text-center">Rating</th>
                            <th class="table-likes text-center">Likes</th>
                            <th class="table-time text-center">Posted at</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse($all_business_comments as $business_comment)
                            @if($business_comment->business->user->id == Auth::user()->id)
                                <tr>
                                    <td class="ps-2"><a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->user->name }}</a></td>
                                    <td><a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->business->name }}</a></td>
                                    <td class="table-comment"><a href="{{ route('profile.review', $business_comment->id) }}" class="text-decoration-none text-secondary">{{ $business_comment->content }}</a></td> 
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
                                    <td class="pe-2">
                                        {{-- delete --}}
                                        <button class="btn btn-sm btn-red " data-bs-toggle="modal" data-bs-target="#delete-review{{$business_comment->id}}">
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
                {{ $all_business_comments->links() }}
            </div>  
            </div>
            <div class="row mt-5">       
                <div class="col align-center mb-0">
                    <a href="{{route('profile.businesses', Auth::user()->id)}}">
                        <button class="btn btn-green text-uppercase w-25 position-absolute start-50 translate-middle mt-1">Back to Profile</button>
                    </a>
                </div>
            </div>
        </div>

    </div>        

</div>
@endsection