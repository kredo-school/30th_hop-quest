<div class="bg-blue">
    @extends('layouts.app')
    
    @section('title', 'Articles')
    
    @section('content')
    <link rel="stylesheet" href="{{asset('css/takeshi.style.css')}}"> 

  <style>
    .form-label{
        font-weight: bold
    }
    </style>          

    <div class="pb-5 row justify-content-center pt-3">       
        <div class="col-8 mb-3">
            <div class="row">
                <div class="col">
                    <h2 class="mb-3 poppins-regular d-inline me-3">Add Promotion</h2>
                    <p class="d-inline">   (<span class="color-red">*</span> is mandatory)<p>
                </div>
            </div>
            {{-- <form action="#" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH') --}}
            {{-- Promotion title --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="title" class="form-label fw-bold">Title<span class="color-red">*</span></label>
                    <input type="text" name="title" id="title" value="" class="form-control">
                </div>
            </div>
            {{-- Retalted business --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="business_id" class="form-label fw-bold">Related Business<span class="color-red">*</span></label>
                    <select name="business_id" id="business_id" class="form-control" placeholder="Select">
                        <option value=""></option>
                        <option value="">Hop Cafe</option>
                        <option value="">Hop Pub</option>
                    </select>
                </div>
            </div>
            {{-- Promotion period --}}
            <div class="row mb-3">
                <div class="col-6">
                    <label for="start_date" class="form-label">Promotion start date<span class="color-red">*</span></label>
                    <input type="date" name="start-date" id="start_date" value="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="end_date" class="form-label">Promotion end date<span class="color-red">*</span></label>
                    <input type="date" name="end-date" id="end_date" value="" class="form-control">
                </div>
            </div>
            {{-- Display period --}}
            <div class="row mb-3">
                <div class="col-6">
                    <label for="display_start" class="form-label">Display start date (optional)</label>
                    <input type="date" name="display-start" id="display_start" value="" class="form-control">
                </div>
                <div class="col-6">
                    <label for="display_end" class="form-label">Display end date (optional)</label>
                    <input type="date" name="display-end" id="display_end" value="" class="form-control">
                </div>
            </div>
            {{-- Introduction --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="description" class="form-label">Introduction<span class="color-red">*</span></label>
                    <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                </div>    
            </div>
            {{-- File --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="photo" class="form-label">Photo upload<span class="color-red">*</span></label>
                    <input type="file" name="photo" id="" class="form-control form-control-sm w-100 mb-auto p-2" >
                    <p class="form-text text-danger">
                        Acceptable formats: jpeg, jpg, png, gif only <br>
                        Max file size is 1048 KB
                    </p>
                </div>
            </div>
            {{-- Buttons --}}
            <div class="row mt-3 ">
                <div class="col">                        
                    <button type="submit" class="btn btn-green w-100 mb-2">CHECK</button>
                </div>
                <div class="col mb-0 mx-auto">
                    <a href="{{route('home')}}">
                        <button class="btn btn-red w-100 ">CANCEL</button>
                    </a>
                </div>
            </div>               
            {{-- </form> --}}
        </div>
    </div>
</div>
@endsection