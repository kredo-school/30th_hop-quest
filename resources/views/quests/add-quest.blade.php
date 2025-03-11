@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/add-quest.css') }}">
@endsection

<div class="bg-green">
@section('content')
    <h3 class="color-navy poppins-semibold text-center">Create Your Quest</h3>
    
    <section id="form1">
        <form action="" method="post" enctype="multipart/form-data" class="bg-white rounded-5 p-5 my-5">
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
                        <p class="mt-0 ps-0 xsmall">
                            Acceptable formats: jpeg, jpg, png, gif only.<br>Max size is 1048 KB
                        </p>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-navy">Create</button>
                </div>

        </form>
    </section>      
    <section id="form2">
        <form action="" method="post" enctype="multipart/form-data" class="bg-white rounded-5 p-5 my-5">
            @csrf
            <div class="row">
                <label class="form-label">Choose the day</label>
                <select id="day_select" class="w-25 p-2 border rounded mb-3"></select>
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

<script src="script.js"></script>
</body>
</html>

</div>
@endsection