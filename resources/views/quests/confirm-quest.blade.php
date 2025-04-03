@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/add-quest.css') }}">
@endsection

@section('title', 'Add Quest - Confirmation')

@section('content')
<div class="bg-green">
    <div class="container py-5 col-9 px-0">
        <h3 class="color-navy poppins-semibold text-center">Check Your Quest</h3>

        <section class="position-relative my-5" id="header">
            <img src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg') }}" alt="header-img" id="header-img" class="img-fluid w-100">

            <div class="overlay position-absolute top-0 end-0 p-3 text-white">
                <div>
                    <button class="btn btn-sm btn-green">
                        <a href="#form1" class="text-decoration-none text-white">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </a>
                    </button>
                    <button class="btn btn-sm btn-red" data-bs-toggle="modal" data-bs-target="#delete-post">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            <div class="overlay position-absolute bottom-0 start-0 p-3 text-white">
                <h3 class="my-0" id="header-title">{{ $quest_a->title }}</h3>
                <h4 class="my-0" id="header-dates">{{ $quest_a->start_date }} - {{ $quest_a->end_date }}</h4>
                <p class="m-0 p-0" id="header-intro">{{ $quest_a->intro }}</p>
            </div>
        </section>

{{-- DELETE MODAL --}}
        <div class="modal fade" id="delete-post">
            <div class="modal-dialog">
                <div class="modal-content border-red">
                    <div class="modal-header">
                        <h3 class="h3"> <i class="fa-solid fa-trash"></i> Delete Post</h3>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this post?</p>
                        <p class="text-center">{{ $quest_a->title }}</p>
                    </div>
                    <div class="modal-footer border-0">
                        <form action="{{ route('quest.delete', $quest_a->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-red">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-red">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

{{-- Quest - Agenda --}}
        <div class="container mt-4">
            <div class="row justify-content-between mt-4">
                <div class="col-md-6 col-lg-5 bg-white rounded-3 mb-4" id="agenda-list">
                    <h4>Quest - Agenda</h4>
                    <ul>
                        <h2>Agenda</h2>
                            @foreach($agenda_bodys->groupBy('day_number') as $day => $bodys)
                                <h3>Day {{ $day }}</h3>
                                <ul>
                                    @foreach($bodys as $body)
                                        <li>{{ $body->some_column }}</li>
                                    @endforeach
                                </ul>
                            @endforeach

                    </ul>
                </div>

                <!-- 右側: Googleマップ -->
                <div class="col-md-6 col-lg-6 px-0">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.146784010381!2d123.903637375094!3d10.33013598979281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9992189a343c3%3A0xa7758b38dbbe1750!2sQQEnglish%20IT%20Park%20Campus!5e0!3m2!1sja!2sph!4v1742469854398!5m2!1sja!2sph" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>

{{-- Quest Details --}}
        @foreach($quest_bodys as $body)
            <section class="container bg-white my-5 rounded-3 p-3 border-red">
                <div class="row px-0">
                    <p class="color-red fs-3 text-center">Day {{ $body->day_number }}</p>
                </div>
                <div class="row px-3">
                    <h4 class="col-md-10 spot-name text-start poppins-bold px-0">{{ $body->spot_name }}</h4>
                    <div class="col ms-0 text-end pe-0">
                        <button class="btn btn-sm btn-green">
                            <a href="#form1" class="text-decoration-none text-white">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                        </button>
                        <button class="btn btn-sm btn-red" data-bs-toggle="modal" data-bs-target="#delete-post">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="row px-0">
                    <div class="col-md-6 spot-image-container">
                        @if($body->image)
                            <img src="{{ asset('storage/' . $body->image) }}" alt="Spot Image" class="spot-image img-fluid image-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-6 mt-4 mt-md-0">
                        <p class="spot-description w-100">{{ $body->description }}</p>
                    </div>
                </div>
            </section>
        @endforeach


        <button class="btn btn-navy w-100 mb-5">
            <a href="" class="text-decoration-none text-white">Back to List</a>
        </button>
    </div>
</div>

@vite(['resources/js/quest/scroll-adjustment.js'])
@endsection
