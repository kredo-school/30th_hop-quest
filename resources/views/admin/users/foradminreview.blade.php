<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Edit Profiles')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}"  /> 

  
    
<!-- Header image -->
    {{-- <div class="row">
        <div class="pt-2 px-0">
            @if($user->header)
                <img src="{{$user->header}}" class="header-image"  alt="">
            @else
                <i class="fa-solid fa-image text-secondary icon-xl d-block text-center"></i>
            @endif
        </div>
    </div> --}}
    
    <div class="row justify-content-center pt-2">
        <div class="col-10">  
            <div class="row mb-3">
                <h3>Applied User Information</h3>
            </div>
        </div>
    </div>
    
    <div class="pb-5 row justify-content-center pt-2">
        <div class="col-10">  
            <div class="row mb-3">
                <!-- Avatar image -->
                <div class="col-auto profile-image">
                    @if($user->avatar)
                        <img src="{{$user->avatar}}" alt="" class="rounded-circle avatar-xl d-block mx-auto">
                    @else
                        <i class="fa-solid fa-circle-user text-secondary profile-xl d-block text-center"></i>
                    @endif
                </div>
            </div>
            {{-- User information --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="name" class="form-label">Business user name<span class="color-red">*</span></label>
                    <input type="text" name="name" id="name" value="{{$user->name}}" class="form-control" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="email" class="form-label">E-mail address<span class="color-red">*</span></label>
                    <input type="email" name="email" id="email" value="{{$user->email}}" class="form-control" readonly>
                </div>
                <div class="col-6">
                    <label for="website_url" class="form-label">Website URL</label>
                    <input type="text" name="website_url" id="website_url" value="{{$user->website_url}}" class="form-control" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label for="zip" class="form-label">ZIP code<span class="color-red">*</span></label>
                    <input type="text" name="zip" id="zip" value="{{$user->zip}}" class="form-control" readonly>
                </div>
                <div class="col-6">
                    <label for="phonenumber" class="form-label">Phone number<span class="color-red">*</span></label>
                    <input type="text" name="phonenumber" id="phonenumber" value="{{$user->phonenumber}}" class="form-control" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="address" class="form-label">Address<span class="color-red">*</span></label>
                    <input type="text" name="address" id="address" value="{{$user->address}}" class="form-control" readonly>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="introduction" class="form-label">Introduction<span class="color-red">*</span></label>
                    <textarea name="introduction" id="introduction" rows="5" class="form-control" value="{{$user->introduction}}" readonly>
                    </textarea>
                </div>    
            </div>
    
            <!-- SNS -->
            <div class="row mb-5">
                <div class="col">
                    <div class="row">
                        <div class="col">
                            <label for="sns" class="form-label">Social media</label>
                        </div>
                    </div>
                </div> 
                <div class="row mb-2">
                    <div class="col-6">   
                        <div class="row">
                            <div class="col-2">
                                <label for="instagram" class="form-label"><i class="fa-brands fa-instagram text-dark icon-md pe-2"></i></label>
                            </div>
                            <div class="col">
                                <input type="text" name="instagram" id="instagram" value="{{$user->instagram}}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>  
                    <div class="col-6">
                        <div class="row">
                            <div class="col-2">
                                <label for="facebook" class="form-label"><i class="fa-brands fa-facebook text-dark icon-md pe-2"></i></label>
                            </div>
                            <div class="col">
                                <input type="text" name="facebook" id="facebook" value="{{$user->facebook}}" class="form-control" readonly>
                            </div>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">   
                        <div class="row">
                            <div class="col-2">
                                <label for="x" class="form-label"><i class="fa-brands fa-x-twitter text-dark icon-md pe-2"></i></label>
                            </div>
                            <div class="col">
                                <input type="text" name="x" id="x" value="{{$user->x}}" class="form-control" readonly>
                            </div>
                        </div>
                    </div>  
                    <div class="col-6">
                        <div class="row">
                            <div class="col-2">
                                <label for="tiktok" class="form-label"><i class="fa-brands fa-tiktok text-dark icon-md pe-2"></i></label>
                            </div>
                            <div class="col">
                                <input type="text" name="tiktok" id="tiktok" value="{{$user->tiktok}}" class="form-control" readonly>
                            </div>
                        </div>    
                    </div>
                </div>
            </div>

            <div class="row mb-5 justify-content-center">
                @if($user->official_certification == 2)
                    <div class="col-4">
                        <form method="POST" action="{{ route('admin.users.certify', $user->id) }}">
                            @csrf
                            <input type="hidden" name="action" value="approve">
                            <button type="submit" class="btn btn-sm btn-green w-100">Approve</button>
                        </form>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        <form method="POST" action="{{ route('admin.users.certify', $user->id) }}">
                            @csrf
                            <input type="hidden" name="action" value="reject">
                            <button type="submit" class="btn btn-sm btn-red w-100">Reject</button>
                        </form>
                    </div>
                @elseif($user->official_certification == 3)
                    <div class="col-4">
                        <button class="btn btn-sm btn-outline-green w-100 mb-3">Approved</button>
                    </div>
                    <div class="col-2"></div>
                    <div class="col-4">
                        <form method="POST" action="{{ route('admin.users.certify', $user->id) }}">
                            @csrf
                            <input type="hidden" name="action" value="revoke">
                            <button type="submit" class="btn btn-sm btn-navy w-100 ">Revoke</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
    </div>

@endsection



