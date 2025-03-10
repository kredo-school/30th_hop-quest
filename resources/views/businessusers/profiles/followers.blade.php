@extends('layouts.app')

@section('title', 'Articles')

@section('content')
    @include('businessusers.profiles.header')

    <div class="mb-5 row justify-content-center ">
        <div class="col-4 mb-5 ">
            <h2 class="text-center">Followers</h2>

            <div class="row">
                <div class="col-auto">
                    <i class="fa-solid fa-circle-user text-secondary icon-sm" ></i>
                </div>
                <div class="col ps-0 text-truncate">
                    <h4>Janet Jackson</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-auto">
                    <i class="fa-solid fa-circle-user text-secondary icon-sm" ></i>
                </div>
                <div class="col ps-0 text-truncate">
                    <h4>Brian Adamz</h4>
                </div>
            </div>

        </div>
    </div>
@endsection