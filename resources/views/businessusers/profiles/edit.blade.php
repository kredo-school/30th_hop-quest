<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Edit Profiles')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}"  /> 
<div class="row justify-content-center pt-5">
    <div class="col-8">
        <div class="row">
            <div class="col">
                <h4 class=" d-inline me-3">Edit Profile</h4>
                <p class="d-inline ">(<span class="color-red fw-bold">*</span> Required items for official certification badge)<p>
            </div>
        </div>
    </div>
</div>

<form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
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

                {{-- <button id="delete-avatar" data-image="{{ Auth::user()->avatar }}">画像を削除</button>

                <script>
                document.getElementById('delete-avatar').addEventListener('click', function() {
                    if (!confirm('画像を削除しますか？')) return;

                    let imageName = this.getAttribute('data-image'); // 画像のファイル名を取得
                
                    fetch("{{ route('profile.avatar.delete') }}", {
                        method: "DELETE",
                        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ image: imageName }) // 画像名をリクエストに含める
                    }).then(response => {
                        if (response.ok) {
                            alert('画像を削除しました');
                            location.reload();
                        } else {
                            alert('削除に失敗しました');
                        }
                    });
                });
                </script> --}}
                @else
                    <i class="fa-solid fa-circle-user text-secondary icon-xl d-block text-center"></i>
                @endif
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
            <div class="col-6">
                <label for="name" class="form-label">Business user name<span class="color-red">*</span></label>
                <input type="text" name="name" id="name" value="{{old('name', Auth::user()->name)}}" class="form-control">
            </div>
            <div class="col-6">
                <label for="email" class="form-label">E-mail address<span class="color-red">*</span></label>
                <input type="email" name="email" id="email" value="{{old('email', Auth::user()->email)}}" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-6">
                <label for="zip" class="form-label">ZIP code<span class="color-red">*</span></label>
                <input type="text" name="zip" id="zip" value="{{old('zip', Auth::user()->zip)}}" class="form-control">
                @error('zip')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-6">
                <label for="phonenumber" class="form-label">Phone number<span class="color-red">*</span></label>
                <input type="text" name="phonenumber" id="phonenumber" value="{{old('phonenumber', Auth::user()->phonenumber)}}" class="form-control">
                @error('phonenumber')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="address" class="form-label">Address<span class="color-red">*</span></label>
                <input type="text" name="address" id="address" value="{{old('address', Auth::user()->address)}}" class="form-control">
                @error('address')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="introduction" class="form-label">Introduction<span class="color-red">*</span></label>
                <textarea name="introduction" id="introduction" rows="3" class="form-control">{{old('introduction', Auth::user()->introduction)}}
                </textarea>
                @error('introduction')
                <p class="mb-0 text-danger small">{{ $message }}</p>
                @enderror
            </div>    
        </div>

        <div class="row mb-3">
            <div class="col-6">
                <label for="instagram" class="form-label"><i class="fa-brands fa-instagram text-dark icon-md pe-2"></i></label>
                <input type="text" name="instagram" id="instagram" value="{{old('instagram', Auth::user()->instagram)}}" class="form-control" placeholder="Instagram account name">
            </div>
            <div class="col-6">
                <label for="facebook" class="form-label"><i class="fa-brands fa-facebook text-dark icon-md pe-3"></i></label>
                <input type="text" name="facebook" id="facebook" value="{{old('facebook', Auth::user()->facebook)}}" class="form-control" placeholder="facebook account name">
            </div>
        </div>
        <div class="row mb-5">
            <div class="col-6">
                <label for="X" class="form-label"><i class="fa-brands fa-x-twitter text-dark icon-md px-0"></i></label>
                <input type="text" name="X" id="X" value="{{old('x', Auth::user()->x)}}" class="form-control" placeholder="X account name">
            </div>
            <div class="col-6">
                <label for="tiktok" class="form-label"><i class="fa-brands fa-tiktok text-dark icon-md px-0"></i></label>
                <input type="text" name="tiktok" id="tiktok" value="{{old('tiktok', Auth::user()->tiktok)}}" class="form-control" placeholder="TikTok account name">
            </div>
        </div>

        <div class="row mt-3 justify-content-center">
            <div class="col-4 ">                        
                <button type="submit" class="btn btn-green w-100 mb-2">SAVE</button>
                <input type="checkbox" class="form-check-input mb-2" name="official_certification" id="official_certification" value="1" 
                {{ old('official_badge', Auth::user()->official_certification) ? 'unchecked' : '' }}
                > Apply for Official certification badge
            </div>
            <div class="col-2"></div>
            <div class="col-4 ">
                <a href="{{route('profile.posts', Auth::user()->id)}}">
                    <button class="btn btn-red w-100 ">CANCEL</button>
                </a>
            </div>
        </div>              
        </form>
    </div>
</div>
</div>
@endsection