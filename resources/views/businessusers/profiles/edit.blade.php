<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Articles')

@section('content')
<link rel="stylesheet" href="{{asset('css/takeshi.style.css')}}"  /> 
<div class="row justify-content-center pt-5">
    <div class="col-8">
        <div class="row">
            <div class="col">
                <h4 class=" d-inline me-3">Edit Profile</h4>
                <p class="d-inline ">   (<span class="color-red fw-bold">* Required items</span>)<p>
            </div>
        </div>
    </div>
</div>

        {{-- <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH') --}}


        <!-- Header image -->
<div class="row">
    <div class="pt-2 px-0">
        <img src="{{ asset('images/resort.jpg') }}" class="header-image"  alt="">
        
    </div>
</div>


<div class="pb-5 row justify-content-center pt-2">
    <div class="col-8"> 
          {{-- Header image upload --}}
        <div class="row mb-3">
            <label for="header" class="form-label mb-2">Header photo</label>
            <input type="file" name="header" id="header" class="form-control form-control-sm w-100 p-2" >
                    <p class="mb-0 form-text text-danger">
                        Acceptable formats: jpeg, jpg, png, gif only <br>
                        Max file size is 1048 KB
                    </p>
        </div>     
        <div class="row mb-3">
            <!-- Avatar image -->
            <div class="col-auto profile-image">
                <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-xl" ></i>
            </div>
            <div class="col">
                <label for="avatar" class="form-label mb-2">Avatar photo</label>
                <input type="file" name="avatar" id="" class="form-control form-control-sm w-100 mb-auto p-2" >
                <p class="mb-0 form-text text-danger">
                    Acceptable formats: jpeg, jpg, png, gif only <br>
                    Max file size is 1048 KB
                </p>
            </div>
        </div>
        {{-- User information --}}
        <div class="row mb-3">
            <div class="col-6">
                <label for="name" class="form-label">Business user name<span class="color-red">*</span></label>
                <input type="text" name="name" id="name" value="" class="form-control">
            </div>
            <div class="col-6">
                <label for="email" class="form-label">E-mail address<span class="color-red">*</span></label>
                <input type="email" name="email" id="email" value="" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="zipcode" class="form-label">ZIP code<span class="color-red">*</span></label>
                <input type="text" name="zipcode" id="zipcode" value="" class="form-control">
            </div>
            <div class="col-6">
                <label for="phonenumber" class="form-label">Phone number<span class="color-red">*</span></label>
                <input type="text" name="phonenumber" id="phonenumber" value="" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="address" class="form-label">Address<span class="color-red">*</span></label>
                <input type="text" name="address" id="address" value="" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="description" class="form-label">Introduction<span class="color-red">*</span></label>
                <textarea name="description" id="description" rows="3" class="form-control"></textarea>
            </div>    
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <label for="instagram" class="form-label"><i class="fa-brands fa-instagram text-dark icon-md pe-2"></i></label>
                <input type="text" name="instagram" id="instagram" value="" class="form-control" placeholder="@Instagram account name">
            </div>
            <div class="col-6">
                <label for="facebook" class="form-label"><i class="fa-brands fa-facebook text-dark icon-md pe-3"></i></label>
                <input type="text" name="facebook" id="facebook" value="" class="form-control" placeholder="facebook account name">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-6">
                <label for="X" class="form-label"><i class="fa-brands fa-x-twitter text-dark icon-md px-0"></i></label>
                <input type="text" name="X" id="X" value="" class="form-control" placeholder="@X account name">
            </div>
            <div class="col-6">
                <label for="tiktok" class="form-label"><i class="fa-brands fa-tiktok text-dark icon-md px-0"></i></label>
                <input type="text" name="tiktok" id="tiktok" value="" class="form-control" placeholder="TikTok account name">
            </div>
        </div>

        <div class="row mt-3 justify-content-center">
            <div class="col-4 ">                        
                <button type="submit" class="btn btn-green w-100 mb-2">SAVE</button>
                <input type="checkbox" class="form-check-input mb-2" name="" id="" value=""> Apply for Official certification badge
            </div>
            <div class="col-2"></div>
            <div class="col-4 ">
                <a href="{{route('profile')}}">
                    <button class="btn btn-red w-100 ">CANCEL</button>
                </a>
            </div>
        </div>              
        {{-- </form> --}}
    </div>
</div>
</div>
@endsection