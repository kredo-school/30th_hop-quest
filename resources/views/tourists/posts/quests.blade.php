<div class="bg-green">
@extends('layouts.app')

@section('title', 'Quests')

@section('content')

@include('tourists.posts.post-header')

<div class="mt-4 mb-5 row justify-content-center">
    <div class="col-8 mb-5 ">
{{-- Followings --}}
        <div class="row mb-3">
            <div class="col">
                <h4>Quests</h4>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-4">
                @include('tourists.posts.post-body')
            </div>
            <div class="col-4">
                @include('tourists.posts.post-body')
            </div>
            <div class="col-4">
                @include('tourists.posts.post-body')
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                @include('tourists.posts.post-body')
            </div>
            <div class="col-4">
                @include('tourists.posts.post-body')
            </div>
            <div class="col-4">
                @include('tourists.posts.post-body')
            </div>
        </div>
    </div>   
</div>
@endsection
