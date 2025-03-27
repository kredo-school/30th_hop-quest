<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Edit Model Quest')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">         

<main>
    <div class="pb-5 row justify-content-center pt-1">       
        <div class="col-8 mb-3">
            <div class="row">
                <div class="col">
                    <h3 class="mb-3 poppins-regular d-inline me-3">Edit Model Quest</h3>
                    <p class="d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-red mb-2 w-100" data-bs-toggle="modal" data-bs-target="#delete-quest">DELETE</button>
                </div>
                @include('businessusers.posts.modelquests.modals.delete')
            </div>
            <form action="{{ route('modelquest.update', $quest->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
            {{-- Promotion title --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="title" class="form-label fw-bold">Title<span class="color-red">*</span></label>
                    <input type="text" name="title" id="title" value="{{old('title', $quest->title)}}" class="form-control">
                    @error('title')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Duration --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="duration" class="form-label">Duration<span class="color-red">*</span></label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', $quest->duration) }}" class="form-control w-25">
                    {{-- @error('duration')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror --}}
                </div>    
            </div>

            {{-- Introduction --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="introduction" class="form-label">Introduction<span class="color-red">*</span></label>
                    <textarea name="introduction" id="introduction" rows="5" class="form-control">{{old('introduction', $quest->introduction)}}</textarea>
                    @error('introduction')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>    
            </div>
            {{-- File --}}
            <div class="row mb-3 ">
                <div class="col">
                    <label for="photo" class="form-label">Photo upload<span class="color-red">*</span></label>
                </div> 
                <div class="row">  
                    <div class="col-4">
                        @if($quest->main_photo)
                        <img src="{{$quest->main_photo}}" class="img-lg"  alt="Model Quest image">
                        @else
                        <i class="fa-solid fa-image text-secondary icon-xl d-block text-center"></i>
                        @endif
                    </div>
                </div>     
            </div>
            <div class="row">
                <div class="col">
                    <input type="file" name="main_photo" id="" class="form-control form-control-sm w-100 mb-auto p-2" >
                    @error('main_photo')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                    <p class="form-text text-danger ">
                        Acceptable formats: jpeg, jpg, png, gif only <br>
                        Max file size is 1048 KB
                    </p>
                </div>
            </div>
            {{-- Buttons --}}
            <div class="row mt-3 justify-content-center">
                <div class="col-4 ">                        
                    {{-- <a href="{{route('promotion.check')}}">
                        <button class="btn btn-green w-100 ">CHECK</button>
                    </a>                        --}}
                    <button type="submit" class="btn btn-green w-100 mb-2">SAVE</button>
                </div>
                <div class="col-2"></div>
                <div class="col-4">
                    <a href="{{route('profile.modelquests', Auth::user()->id)}}">
                        <div class="btn btn-red w-100 ">CANCEL</div>
                    </a>
                </div>
            </div>               
            </form>
        </div>
    </div>
</main>
</div>
@endsection