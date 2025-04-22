@if(Auth::user()->role_id == 1)
    <div class="bg-navy text-white">
@else
    <div class="bg-blue text-dark">
@endif

@extends('layouts.app')

@section('title', 'Edit Profiles')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}"  /> 
<div class="row justify-content-center pt-5">
    <div class="col-8">
        <div class="row">
            <div class="col">
                <h4 class=" d-inline me-3">Edit Profile</h4>
                @if(Auth::user()->role_id == 1)
                    <p class="d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                @elseif(Auth::user()->role_id == 2)
                    <p class="d-inline ">(<span class="color-red fw-bold">*</span> Required items for official certification badge)<p>
                @endif
            </div>
        </div>
    </div>
</div>

<form action="{{ route('profile.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PATCH')


        <!-- Header image -->
<div class="row">
    <div class="pt-2 px-0">
        @if(Auth::user()->header)
            <img src="{{Auth::user()->header}}" class="header-image"  alt="">
        @else
            <i class="fa-solid fa-image text-secondary icon-xl d-block text-center"></i>
        @endif
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
            @error('header')
            <p class="mb-0 text-danger small">{{ $message }}</p>
            @enderror
        </div>     
        <div class="row mb-3">
            <!-- Avatar image -->
            <div class="col-auto profile-image">
                @if(Auth::user()->avatar)
                    <img src="{{Auth::user()->avatar}}" alt="" class="rounded-circle avatar-xl d-block mx-auto">                          
                @else
                    <i class="fa-solid fa-circle-user text-secondary profile-xl d-block text-center"></i>
                @endif
                <!--delete-->
                {{-- <button type="button" id="delete-avatar" data-image="{{ Auth::user()->avatar }}"><i class="delete-avatar fa-solid fa-trash text-danger"></i></button>      
                <script>
                    document.addEventListener("DOMContentLoaded", function () {
                        const deleteBtn = document.getElementById('delete-avatar');
                        if (!deleteBtn) return;
                    
                        deleteBtn.addEventListener('click', function () {
                            if (!confirm('画像を削除しますか？')) return;
                    
                            fetch("{{ route('profile.avatar.delete') }}", {
                                method: "DELETE",
                                headers: {
                                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    alert('画像を削除しました');
                                    location.reload();
                                } else {
                                    alert('削除に失敗しました');
                                }
                            });
                        });
                    });
                    </script> --}}
            </div>
            <div class="col">

                
                
                <label for="avatar" class="form-label mb-2">Avatar photo</label>
                <input type="file" name="avatar" id="" class="form-control form-control-sm w-100 mb-auto p-2" >
                
                <p class="mb-0 form-text text-danger">
                    Acceptable formats: jpeg, jpg, png, gif only <br>
                    Max file size is 1048 KB
                </p>
                @error('avatar')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
        {{-- User information --}}
        <div class="row mb-3">
            <div class="col">
                <label for="name" class="form-label">Business user name<span class="color-red">*</span></label>
                <input type="text" name="name" id="name" value="{{old('name', Auth::user()->name)}}" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="email" class="form-label">E-mail address<span class="color-red">*</span></label>
                <input type="email" name="email" id="email" value="{{old('email', Auth::user()->email)}}" class="form-control">
            </div>
            <div class="col-6">
                <label for="website_url" class="form-label">Website URL</label>
                <input type="text" name="website_url" id="website_url" value="{{old('email', Auth::user()->website_url)}}" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                @if(Auth::user()->role_id == 1)
                    <label for="zip" class="form-label">ZIP code</label>
                    <input type="text" name="zip" id="zip" value="{{old('zip', Auth::user()->zip)}}" class="form-control">
                @elseif(Auth::user()->role_id == 2)
                    <label for="zip" class="form-label">ZIP code<span class="color-red">*</span></label>
                    <input type="text" name="zip" id="zip" value="{{old('zip', Auth::user()->zip)}}" class="form-control">
                @endif
                @error('zip')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                @if(Auth::user()->role_id == 1)
                    <label for="phonenumber" class="form-label">Phone number</label>
                    <input type="text" name="phonenumber" id="phonenumber" value="{{old('phonenumber', Auth::user()->phonenumber)}}" class="form-control">
                @elseif(Auth::user()->role_id == 2)
                    <label for="phonenumber" class="form-label">Phone number<span class="color-red">*</span></label>
                    <input type="text" name="phonenumber" id="phonenumber" value="{{old('phonenumber', Auth::user()->phonenumber)}}" class="form-control">
                @endif
                @error('phonenumber')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                @if(Auth::user()->role_id == 1)
                    <label for="address" class="form-label">Address</label>
                    <input type="text" name="address" id="address" value="{{old('address', Auth::user()->address)}}" class="form-control">
                @elseif(Auth::user()->role_id == 2)
                    <label for="address" class="form-label">Address<span class="color-red">*</span></label>
                    <input type="text" name="address" id="address" value="{{old('address', Auth::user()->address)}}" class="form-control">
                @endif
                @error('address')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                @if(Auth::user()->role_id == 1)
                    <label for="introduction" class="form-label">Introduction</label>
                    <textarea name="introduction" id="introduction" rows="5" class="form-control">{{old('introduction', Auth::user()->introduction)}}
                    </textarea>
                @elseif(Auth::user()->role_id == 2)
                    <label for="introduction" class="form-label">Introduction<span class="color-red">*</span></label>
                    <textarea name="introduction" id="introduction" rows="5" class="form-control">{{old('introduction', Auth::user()->introduction)}}
                    </textarea>
                @endif
                @error('introduction')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>    
        </div>

        <div class="row mb-5">
            <div class="col">
                <div class="row mb-2">
                    <div class="col">
                        <label for="sns" class="form-label">Social media</label>
                    </div>
                </div>
            </div> 
            <div class="row mb-2">
                <div class="col-6">   
                    <div class="row">
                        <div class="col-1">
                            <label for="instagram" class="form-label"><i class="fa-brands fa-instagram icon-md pe-2"></i></label>
                        </div>
                        <div class="col">
                            <input type="text" name="instagram" id="instagram" value="{{old('instagram', Auth::user()->instagram)}}" class="form-control" placeholder="Instagram account name">
                        </div>
                    </div>
                </div>  
                <div class="col-6">
                    <div class="row">
                        <div class="col-1">
                            <label for="facebook" class="form-label"><i class="fa-brands fa-facebook icon-md pe-2"></i></label>
                        </div>
                        <div class="col">
                            <input type="text" name="facebook" id="facebook" value="{{old('instagram', Auth::user()->facebook)}}" class="form-control" placeholder="facebook account name">
                        </div>
                    </div>    
                </div>
            </div>
            <div class="row">
                <div class="col-6">   
                    <div class="row">
                        <div class="col-1">
                            <label for="x" class="form-label"><i class="fa-brands fa-x-twitter icon-md pe-2"></i></label>
                        </div>
                        <div class="col">
                            <input type="text" name="x" id="x" value="{{old('x', Auth::user()->x)}}" class="form-control" placeholder="X account name">
                        </div>
                    </div>
                </div>  
                <div class="col-6">
                    <div class="row">
                        <div class="col-1">
                            <label for="tiktok" class="form-label"><i class="fa-brands fa-tiktok icon-md pe-2"></i></label>
                        </div>
                        <div class="col">
                            <input type="text" name="tiktok" id="tiktok" value="{{old('tiktok', Auth::user()->tiktok)}}" class="form-control" placeholder="tiktok account name">
                        </div>
                    </div>    
                </div>
            </div>
        </div>

        <div class="row mt-3 justify-content-center">
            <div class="col-4 ">                        
                <button type="submit" class="btn btn-green w-100 mb-2">SAVE</button>
                @if(Auth::user()->role_id == 2)
                <input type="checkbox" class="form-check-input mb-2" name="official_certification" id="official_certification" value="2" 
                {{ old('official_badge', Auth::user()->official_certification == 2) ? 'unchecked' : '' }}
                > Apply for Official certification badge
                @endif
            </div>
            <div class="col-2"></div>
            <div class="col-4 ">
                <a href="{{route('profile.header', Auth::user()->id)}}">
                    <button class="btn btn-red w-100 ">CANCEL</button>
                </a>
            </div>
        </div>              
        </form>
    </div>
</div>
</div>
@endsection