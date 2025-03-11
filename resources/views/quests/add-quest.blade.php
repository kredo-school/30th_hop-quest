@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/add-quest.css') }}">
@endsection


@section('content')
<div class="bg-green">
    <div class="container py-5 col-9">
    <h3 class="color-navy poppins-semibold text-center">Create Your Quest</h3>
    
    <section id="form1">
        <form action="" method="post" enctype="multipart/form-data" class="bg-white rounded-4 p-5 my-3">
            @csrf
                <div class="row pb-3">
                    <label for="title" class="form-label">Quest Title</label>
                    <input type="text" name="title" id="name" class="input-box" placeholder="Kyoto Trip">
                </div>

                <div class="row pb-3">
                    <div class="col-5 px-0">
                    <label for="startdate" class="form-label">Start date</label>
                    <input type="date" name="sdate" id="sdate" class="input-box">
                    </div>
                    <div class="col d-flex align-items-end justify-content-center">
                        <i class="fa-solid fa-caret-right icon-md"></i>
                    </div>
                    <div class="col-5 px-0">
                        <label for="enddate" class="form-label">End date</label>
                        <input type="date" name="edate" id="edate" class="input-box form-control">
                    </div>
                </div>
                <div class="row pb-3">
                    <label for="introduction" class="form-label">Introduction</label>
                    <input type="text" name="intro" id="intro" class="input-box" placeholder="3 days trip with my family!">
                </div>
                <div class="row pb-3">
                    <label for="photo" class="form-label">Header photo</label>
                    <div class="col-9 ps-0">
                        <input type="file" name="h-photo" id="h_photo" class="custom-file-input form-control">
                    </div>
                    <div class="col-3 ms-auto pe-0">
                        <label for="h_photo" class="btn btn-green custom-file-label w-100"><i class="fa-solid fa-plus icon-xs d-inline"></i>Photo</label>
                    </div>
                        <p class="mt-0 ps-0 pb-0 xsmall">
                            Acceptable formats: jpeg, jpg, png, gif only.<br>Max size is 1048 KB
                        </p>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-navy">Create</button>
                </div>

        </form>
    </section>      
    <section id="form2">
        <form action="" method="post" enctype="multipart/form-data" class="bg-white rounded-5 px-5 py-3 my-5">
            @csrf
            <div class="row">
                <label class="form-label">Choose the day</label>
                <select id="day_select" name="day_select" class="w-25 p-2 border rounded mb-3">
                    <option value="1">Day1</option>
                    <option value="2">Day2</option>
                    <option value="3">Day3</option>
                </select>
                
            </div>
            <div class="row">
                <div class="col-5 p-0">
                    <label class="form-label">Search Spot on HopQuest</label>
                </div>
                <div class="col-2">
                    
                </div>
                <div class="col-5">
                    <p class="m-0 xsmall">No spot on HopQuest? Tell us your fav spot!</p>
                </div>
             </div>
             <div class="row">
                <div class="col-5 px-0">
                    <form action="" method="get">
                        @csrf
                        <input type="text" name="search" value="" placeholder="Tokyo Tower" class="input-box ms-auto mb-3 w-100">
                    </form>
                </div>
                <div class="col-2">
                    <p class="m-0 pb-3 fs-4 text-center fw-bold">or</p>
                </div>
                <div class="col-5">
                    <a href="" class="btn btn-blue w-100"><i class="fa-solid fa-plus icon-xs d-inline"></i>ADD SPOT</a>
                </div>
             
                <div class="row pb-3 px-0 mx-0">
                    <label for="photo" class="form-label">photos</label>
                    <div class="col-9 ps-0">
                        <input type="file" name="h-photo" id="h_photo" class="custom-file-input form-control ms-0">
                    </div>
                    <div class="col-3">
                        <label for="h_photo" class="btn btn-green custom-file-label w-100"><i class="fa-solid fa-plus icon-xs d-inline"></i>Photo</label>
                    </div>
                        <p class="mt-0 ps-0 xsmall">
                            Acceptable formats: jpeg, jpg, png, gif only.<br>Max size is 1048 KB
                        </p>
                </div>
            <div class="row pb-3 mx-0 ps-0">
                <label class="form-label">Description</label>
                <textarea id="description" class="text-area" rows="5" placeholder="How was your expericence there!"></textarea>
            </div>
            <div class="row pb-3">
                <div class="form-check-inline">
                    <input type="checkbox" name="agenda" class="form-check-input mx-0"><label for="agenda" class="form-check-label ms-3 radio-inline raleway-semibold">Add to Agenda</label>
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
    </section>
    <section class="position-relative">
        <img src="{{ asset('images/pexels-pixabay-459203.jpg') }}" alt="Header Photo" class="img-fluid w-100">
    
        <!-- 右上のオーバーレイ部分 -->
        <div class="overlay position-absolute top-0 end-0 p-3 text-white">
            <!-- 編集・削除ボタン -->
            <div>
                <button class="btn btn-sm btn-green"><i class="fa-solid fa-pen-to-square"></i></button>
                <button class="btn btn-sm btn-red"><i class="fa-solid fa-trash"></i></button>
            </div>
        </div>
        <div class="overlay position-absolute bottom-0 start-0 p-3 text-white">
            <!-- タイトル -->
            <h3 class="my-0">JAPAN FUN TRIP</h3>
            <!-- 日付 -->
            <h4 class="my-0">2025-03-11</h4>
            <!-- 紹介文 -->
            <p class="my-0">これは紹介文です。ここに簡単な説明を入れます。</p>
        </div>
    </section>

<script src="script.js"></script>

</div>
</body>
</html>

</div>
@endsection