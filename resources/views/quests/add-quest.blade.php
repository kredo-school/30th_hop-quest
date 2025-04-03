@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/add-quest.css') }}">
@endsection

@section('title', 'Add Quest')

@section('content')

<div class="bg-green">
    <div class="container py-5 col-9">
        <h3 class="color-navy poppins-semibold text-center">Create Your Quest</h3>
        <div id="responseMessage"></div>
            <div id="responseMessage2"></div>
            <div id="responseMessage"></div>
        <section>
            {{-- @php
                $questId = request('quest_id'); // URL から quest_id を取得
                $quest = isset($questId) ? \App\Models\Quest::find($questId) : null;
            @endphp --}}
            <form action="{{ request('quest_id') ? route('quest.update', request('quest_id')) : route('quest.store') }}" method="POST" enctype="multipart/form-data" id="form1" class="bg-white rounded-4 p-5 my-3">

                <meta name="csrf-token" content="{{ csrf_token() }}">
                @csrf
                @method('POST')
                

                <input type="hidden" name="quest_id_hidden" id="quest_id_hidden" value="{{request('quest_id')}}">
                    <div class="row pb-3">
                        <label for="title" class="form-label">Quest Title</label>
                        <input type="text" name="title" id="title" class="input-box" placeholder="Kyoto Trip" value="{{ $quest->title ?? ''}}">
                        @error('title')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="row pb-3">
                        <div class="col-5 px-0">
                        <label for="start_date" class="form-label">Start date</label>
                        <input type="date" name="start_date" id="start_date" class="input-box" value="{{ old('start_date', $quest->start_date ?? '') }}">
                        @error('start_date')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                        </div>
                        <div class="col d-flex align-items-end justify-content-center">
                            <i class="fa-solid fa-caret-right icon-md"></i>
                        </div>
                        <div class="col-5 px-0">
                            <label for="end_date" class="form-label">End date</label>
                            <input type="date" name="end_date" id="end_date" class="input-box form-control" value="{{ old('end_date', $quest->end_date ?? '') }}">
                            @error('end_date')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                        </div>
                    </div>
                    {{-- <div class="row pb-3">
                        <label for="duration" class="form-label">Choose Quest duration</label>
                        <select id="duration" name="duration" class="w-25 p-2 border rounded mb-1">
                            <option value="1">1 Day</option>
                            <option value="2">2 Days</option>
                            <option value="3">3 Days</option>
                            <option value="4">4 Days</option>
                            <option value="5">5 Days</option>
                            <option value="6">6 Days</option>
                            <option value="7">7 Days</option>
                            <option value="8">8 Days</option>
                            <option value="9">9 Days</option>
                            <option value="10">10 Days</option>
                        </select>
                    </div> --}}
                    <div class="row pb-3">
                        <label for="introduction" class="form-label">Introduction</label>
                        <textarea name="introduction" id="introduction" class="text-area mx-0" cols="30" rows="5" placeholder="My trip to Kyoto was an unforgettable experience filled with history, culture, and breathtaking scenery. From exploring the serene temples of Kinkaku-ji and Fushimi Inari Taisha to strolling through the charming streets of Gion, every moment was magical. The delicious Kyoto cuisine, such as matcha sweets and yudofu, added to the experience. The city's blend of tradition and modernity left a lasting impression, making me want to visit again. Kyoto truly captures the essence of Japan.">{{ old('introduction', $quest->introduction ?? '') }}</textarea>
                        @error('introduction')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row pb-3">
                        <label for="main_image" class="form-label">Header photo</label>
                        <div class="col-9 ps-0">
                            <input type="file" name="main_image" id="main_image" class="custom-file-input form-control">
                            @error('file')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                            <!-- Base64 画像データを格納する hidden input -->
                        <input type="hidden" id="hidden_image_data" name="hidden_image_data">       
                        </div>
                        <div class="col-3 ms-auto pe-0">
                            <label for="main_image" class="btn btn-green custom-file-label w-100"><i class="fa-solid fa-plus icon-xs d-inline"></i>Photo</label>
                        </div>
                            <p class="mt-0 ps-0 pb-0 xsmall">
                                Acceptable formats: jpeg, jpg, png, gif only.<br>Max size is 1048 KB
                            </p>
                    </div>
                    <div class="row">
                        {{-- <input type="hidden" name="quest_id" id="quest_id_input" value="{{ request('quest_id') }}"> --}}
                        {{-- @if(isset($quest) && $quest->id) --}}
                            <button type="submit" name="submit1" id="update" class="btn btn-navy d-none">Update</button>
                        {{-- @else --}}
                            <button type="submit" name="submit1" id="submit1" class="btn btn-navy">Create</button>
                        {{-- @endif --}}
                        
                    </div>

            </form>
        </section>   
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
        <section id="form2" class="d-none">
            <form action="{{ route('quest.storebody') }}" method="post" enctype="multipart/form-data" id="body_form" class="bg-white rounded-5 px-5 py-3 my-5">
                @csrf
                <input type="hidden" name="quest_id" id="quest_id_input" value="{{ request('quest_id') }}">
                <div class="row p-2">
                    <label for="day_number" class="form-label">Choose the day</label>
                    <select id="day_number" name="day_number" class="w-25 p-2 border rounded mb-3">
                        <option value="1">Day1</option>
                        <option value="2">Day2</option>
                        <option value="3">Day3</option>
                    </select>
                    
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <label for="spot_name" class="form-label">Search Spot on HopQuest</label>
                    </div>
                    <div class="col-md-2">
                        
                    </div>
                    <div class="col-lg-5 d-none d-lg-block">
                        <p class="m-0 px-0 xsmall">No spot on HopQuest? Tell us your fav spot!</p>
                    </div>
                </div>
                <div class="row">

                    <div class="col-lg-5 position-relative">
                        <p id="warning"  class="color-red fs-8 p-0 m-0 d-none ">リストから選択してください</p>
                            <input type="text" name="spot_name" id="spot_name" value="" placeholder="Tokyo Tower" class="input-box form-control ms-auto w-100 mb-0">
                        <div id="searchResults" class="search-results mt-0"></div>
                        <input type="hidden" name="spot_business_type" id="spot_business_type">
                        <input type="hidden" name="spot_business_id" id="spot_business_id">
                    </div>
                    <div class="col-lg-2">
                        <p class="m-0 fs-4 text-center fw-bold">or</p>
                    </div>
                {{-- for responsive use --}}
                    <div class="col-lg-5">
                        <p class="m-0 p-0 xsmall d-lg-none">No spot on HopQuest? Tell us your fav spot!</p>
                        <a href="" class="btn btn-blue w-100 px-0"><i class="fa-solid fa-plus icon-xs d-inline"></i>ADD SPOT</a>
                    </div>
                    {{-- <div class="row pb-3">
                        <label for="spot-title" class="form-label">Spot title</label>
                        <input type="text" name="spot-title" id="spot-title" class="input-box" placeholder="Souvenior Shop!">
                    </div> --}}
                
                    <div class="row pb-3 pe-0">
                        <label for="image" class="form-label p-2">Photos</label>
                        <div class="col-9">
                            <input type="file" name="image" id="image" class="custom-file-input form-control" multiple>
                        </div>
                        <div class="col-3 pe-0">
                            <button class="btn btn-green custom-file-label w-100 me-0" id="upload-btn">
                                <i class="fa-solid fa-plus icon-xs d-inline"></i>Photo
                            </button>
                        </div>
                    <div class="row">
                        <p class="mt-0 xsmall">
                            Acceptable formats: jpeg, jpg, png, gif only.<br>Max size is 1048 KB
                        </p>
                    </div>
                    </div>
                    
                    <!-- 📌 アップロードした画像のファイル名を表示するエリア -->
                    <div id="uploaded-file-names" class="mt-2"></div>
                    
                    <div class="row">
                        <label for="spot_description" class="form-label p-2">Description</label>
                        <textarea id="spot_description" name="spot_description" class="text-area mx-2" rows="5" placeholder="How was your expericence there!"></textarea>
                        @error('spot_description')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="row">
                        <div class="form-check form-switch mx-2">
                            <input type="checkbox" name="agenda" id="agenda" class="form-check-input">
                            <label for="agenda" class="form-check-label radio-inline raleway-semibold">Add to Agenda</label>

                            <p class="mt-0 xsmall">
                                The Agenda will display a summary of your Quest. You can select up to three items per day. <br>
                                You can later modify the content displayed in the Agenda on the Edit page.
                            </p>
                        </div>
                    </div>
                    <div class="row pb-3 mx-0 justify-content-end">
                        <button type="submit" id="addon" class="btn btn-navy w-50"><i class="fa-solid fa-plus icon-xs d-inline"></i>Add on your quest</button>
                    </div>
                </div>
            </form>
        </section>

        <section class="d-none" id="header">
            <div class="position-relative my-4">
                <img src="" alt="header-img" id="header-img" class="img-fluid w-100">
            
                <!-- 右上のオーバーレイ部分 -->
                <div class="overlay position-absolute top-0 end-0 p-3 text-white">
                    <!-- 編集・削除ボタン -->
                    <div>
                        <button class="btn btn-sm btn-green"><a href="#form1" class="text-decoration-none text-white"><i class="fa-solid fa-pen-to-square"></i></a></button>
                        <button class="btn btn-sm btn-red" data-bs-toggle="modal" data-bs-target="#delete-post"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <div class="overlay position-absolute bottom-0 start-0 p-3 text-white">
                    <!-- タイトル -->
                    <h3 class="my-0" id="header-title"></h3>
                    <!-- 日付 -->
                    <h4 class="my-0" id="header-dates"></h4>
                </div>
            </div>
            <div class="bg-white rounded-4 my-4">
                <!-- 紹介文 -->
                <p class="my-0" id="header-intro"></p>
            </div>
        </section>

        @include('quests.modals.delete-modal')

        <!-- dayセクションを追加する場所 -->
        <div id="day-container">
            
        </div>

            <button class="btn btn-navy w-100 mb-5 d-none" id="confirmBtn"><a href="" class="text-decoration-none text-white">Check</a></button>
    </div>
</div>
@vite(['resources/js/quest/add-quest.js'])
@endsection
