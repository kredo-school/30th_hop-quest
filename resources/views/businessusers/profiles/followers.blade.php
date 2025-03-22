<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Followers')

@section('content')
    @include('businessusers.profiles.header')

    @if($user->followers->isNotEmpty())
    <div class="row justify-content-center">
        <div class="col-4">
            <h3 class="text-center">Followers</h3>

            @foreach($user->followers as $follower)
                <div class="row mb-3 align-items-center bg-white p-3 rounded-4">
                    <div class="col-auto">
                        {{-- icon/avatar --}}
                        {{-- <a href="{{route('profile.show', $follower->follower->id)}}"> --}}
                        <a href="#">
                            @if($follower->follower->avatar)
                                <img src="{{$follower->follower->avatar}}" alt="" class="rounded-circle avatar-sm">
                            @else
                                 <i class="fa-solid fa-circle-user text-secondary icon-sm"></i>
                            @endif
                        </a>
                    </div>
                    <div class="col ps-0 text-truncate">
                        {{-- name --}}
                        {{-- <a href="{{route('profile.show', $follower->follower->id)}}" 
                            class="text-decoration-none text-dark fw-bold"> --}}
                        <a href="#" class="text-decoration-none text-dark fw-bold">
                            {{$follower->follower->name}}
                        </a>
                    </div>
                    <div class="col-auto mt-3">
                        {{-- button --}}
                        @if($follower->follower->id != Auth::user()->id)
                            @if($follower->follower->isFollowed())
                                {{-- unfollow --}}
                                <form action="{{route('follow.delete', $follower->follower->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-following">Following</button>
                                </form>
                            @else  
                                {{-- follow --}}
                                <form action="{{route('follow.store', $follower->follower->id)}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn-follow">Follow</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@else
    <h4 class="h5 text-center text-secondary">No followers yet.</h4>
@endif

@endsection