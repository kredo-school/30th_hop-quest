<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    @include('businessusers.profiles.header')

    <div class="mb-5 row justify-content-center ">
        <div class="col-4 mb-5 ">
            <h2 class="text-center">Followers</h2>

            <div class="row rounded-3 bg-white py-3 mb-1 align-items-center">
                <div class="col-auto">
                    <i class="fa-solid fa-circle-user text-secondary icon-md" ></i>
                </div>
                <div class="col text-truncate ">
                    <span class="">Janet Jackson</span>
                </div>
            </div>

            <div class="row rounded-3 bg-white py-3 mb-1 align-items-center">
                <div class="col-auto">
                    <i class="fa-solid fa-circle-user text-secondary icon-md" ></i>
                </div>
                <div class="col text-truncate">
                    <span class="">Brian Adamz</span>
                </div>
            </div>
            <div class="row rounded-3 bg-white py-3 mb-1 align-items-center">
                <div class="col-auto">
                    <i class="fa-solid fa-circle-user text-secondary icon-md" ></i>
                </div>
                <div class="col text-truncate ">
                    <span class="">Janet Jackson</span>
                </div>
            </div>

            <div class="row rounded-3 bg-white py-3 mb-1 align-items-center">
                <div class="col-auto">
                    <i class="fa-solid fa-circle-user text-secondary icon-md" ></i>
                </div>
                <div class="col text-truncate">
                    <span class="">Brian Adamz</span>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection