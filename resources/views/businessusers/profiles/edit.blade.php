@extends('layouts.app')

@section('title', 'Articles')

@section('content')
<link rel="stylesheet" href="{{asset('css/takeshi.style.css')}}"  /> 
<div class="pb-5 row justify-content-center bg-blue pt-3">
    <div class="col-8">
        <h2 class="h4 text-dark mb-3">Update Profile</h2>
        <form action="#" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="profile-header ">
                <!-- Header image -->
                <div class="header-image mb-3">
                    {{-- <img src="{{ asset('images/resortpool.jpg') }}" class=" mb-3"  alt=""> --}}
                    <input type="file" name="avatar" id="" class="form-control form-control-sm w-100 mt-1 mb-auto" placeholder="Header file upload">
                            <p class="mb-0 form-text text-danger">
                                Acceptable formats: jpeg, jpg, png, gif only <br>
                                Max file size is 1048 KB
                            </p>
                </div>
                <div class="profile-info container">
                    <div class="row mb-3">
                        <!-- Avatar image -->
                        <div class="col-auto profile-image">
                            <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-lg" ></i>
                        </div>
                        <div class="col">
                            <input type="file" name="avatar" id="" class="form-control form-control-sm w-100 mt-1 mb-auto" placeholder="Avatar file upload">
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
                            <label for="description" class="form-label  mt-3">Introduction<span class="color-red">*</span></label>
                            <textarea name="description" id="description" rows="3" class="form-control"></textarea>
                        </div>    
                    </div>

                    <div class="row mb-3">
                        <div class="col-6">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input type="text" name="instagram" id="instagram" value="" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="facebook" class="form-label">facebook</label>
                            <input type="text" name="facebook" id="facebook" value="" class="form-control">
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-6">
                            <label for="X" class="form-label">X</label>
                            <input type="text" name="X" id="X" value="" class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="tiktok" class="form-label">TikTok</label>
                            <input type="text" name="tiktok" id="tiktok" value="" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            
                            <button type="submit" class="btn btn-green w-100">SAVE</button>
                            <input type="checkbox" class="form-check-input mb-2"> Apply for Official certification badge
                        </div>
                        <div class="col-6 mb-0">
                            <a href="{{route('home')}}">
                                <button class="btn btn-red w-100">CANCEL</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
                
        </form>
    </div>
@endsection