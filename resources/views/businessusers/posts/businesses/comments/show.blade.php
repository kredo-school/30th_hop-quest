@extends('layouts.app')

@section('title', 'comments details')

@section('css')
<link rel="stylesheet" href="{{ asset('css/viewbusiness-comments.css') }}">
@endsection

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">REVIEWS OF {{ $business->name }}</h4>
                </div>
                <div class="card-body">
                    @foreach($comments as $comment)
                    <div class="mb-4 comment-item">
                        <div class="comment-header">
                            <div class="user-info">
                                @if($comment->user->avatar)
                                    <img src="{{ asset('storage' .$comment->user->avatar) }}" alt="User Avatar" class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 50px;"></i>
                                @endif
                                <div class="ms-3">
                                    <h5 class="mb-0">{{ $comment->user->name }}</h5>
                                    <small class="text-muted">POSTED: {{ $comment->created_at->format('Y年m月d日 H:i') }}</small>
                                    @if($comment->created_at != $comment->updated_at)
                                        <small class="text-muted d-block">UPDATED: {{ $comment->updated_at->format('Y年m月d日 H:i') }}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="comment-stars" data-rating="{{ $comment->rating }}">
                                <i class="fa-regular fa-star text-warning"></i>
                                <i class="fa-regular fa-star text-warning"></i>
                                <i class="fa-regular fa-star text-warning"></i>
                                <i class="fa-regular fa-star text-warning"></i>
                                <i class="fa-regular fa-star text-warning"></i>
                            </div>
                        </div>
                        
                        <div class="border-top border-bottom py-3 my-3">
                            <p class="mb-0">{{ $comment->content }}</p>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                @if(Auth::check())
                                    @if($comment->isLiked())
                                        <form action="{{ route('business.comments.like.delete', $comment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger">
                                                <i class="fa-solid fa-heart"></i>
                                                {{ $comment->BusinessCommentLikes->count() }}
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('business.comments.like.store', $comment->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm text-secondary">
                                                <i class="fa-regular fa-heart"></i>
                                                {{ $comment->BusinessCommentLikes->count() }} 
                                        </form>
                                    @endif
                                @else
                                    <span class="btn btn-sm text-secondary">
                                        <i class="fa-regular fa-heart"></i>
                                        {{ $comment->BusinessCommentLikes->count() }}
                                    </span>
                                @endif
                            </div>
                            
                            @if(Auth::check() && Auth::id() === $comment->user_id)
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $comment->id }}">
                                        <i class="fa-solid fa-trash me-1"></i> DELETE
                                    </button>
                                </div>
                                
                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $comment->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $comment->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $comment->id }}">Delete Review</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this review?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('business.comments.like.delete', $comment->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    @if(!$loop->last)
                        <hr class="my-4">
                    @endif
                    @endforeach
                    
                    @if($comments->isEmpty())
                        <div class="alert alert-info">
                            There are no reviews for this business yet.
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="text-center mt-4">
                <a href="{{ route('business.show', $business->id) }}" class="btn btn-outline-secondary">
                    BACK TO BUSINESS PAGE
                </a>
            </div>
        </div>
    </div>
</div>

{{--promotion carousel --}}
<script src="{{ asset('js/viewbusiness.js') }}"></script>
    
@endsection