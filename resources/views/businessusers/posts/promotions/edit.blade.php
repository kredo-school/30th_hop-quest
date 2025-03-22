<div class="bg-blue">
@extends('layouts.app')

@section('title', 'Promotion Edit')

@section('content')
<link rel="stylesheet" href="{{asset('css/style.css')}}">         

<main>
    <div class="pb-5 row justify-content-center pt-1">       
        <div class="col-8 mb-3">
            <div class="row">
                <div class="col">
                    <h3 class="mb-3 poppins-regular d-inline me-3">Edit Promotion</h3>
                    <p class="d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                </div>
                <div class="col-2">
                    <button class="btn btn-sm btn-red mb-2 w-100" data-bs-toggle="modal" data-bs-target="#delete-promotion">DELETE</button>
                </div>
                @include('businessusers.posts.promotions.modals.delete')
            </div>
            <form action="{{ route('promotion.update', $promotion->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
            {{-- Promotion title --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="title" class="form-label fw-bold">Title<span class="color-red">*</span></label>
                    <input type="text" name="title" id="title" value="{{old('title', $promotion->title)}}" class="form-control">
                    @error('title')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            {{-- Retalted business --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="business_id" class="form-label fw-bold">Related Business<span class="color-red">*</span></label>
                    <select name="business_id" id="business_id" class="form-control">
                        @forelse ($all_businesses as $business)
                            @if ($promotion->business_id === $business->id)
                                <option value="{{ $business->id }}" selected>{{ $business->name }}</option>
                            @else
                                <option value="{{ $business->id }}">{{ $business->name }}</option>
                            @endif
                        @empty
                        @endforelse
                        @error('business_id')
                        <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                    </select>
                </div>
            </div>
            {{-- Promotion period --}}
            <div class="row mb-3">
                <div class="col-6">
                    <label for="promotion_start" class="form-label">Promotion start date<span class="color-red">*</span></label>
                    <input type="date" name="promotion_start" id="promotion_start" value="{{old('promotion_start', $promotion->promotion_start)}}" class="form-control">
                </div>
                <div class="col-6">
                    <label for="promotion_end" class="form-label">Promotion end date<span class="color-red">*</span></label>
                    <input type="date" name="promotion_end" id="promotion_end" value="{{old('promotion_end', $promotion->promotion_end)}}" class="form-control">
                </div>
            </div>
            {{-- Display period --}}
            <div class="row mb-3">
                <div class="col-6">
                    <label for="display_start" class="form-label">Display start date</label>
                    <input type="date" name="display_start" id="display_start" value="{{old('display_start', $promotion->display_start)}}" class="form-control">
                </div>
                <div class="col-6">
                    <label for="display_end" class="form-label">Display end date</label>
                    <input type="date" name="display_end" id="display_end" value="{{old('display_end', $promotion->display_end)}}" class="form-control">
                </div>
            </div>
            {{-- Introduction --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="introduction" class="form-label">Introduction<span class="color-red">*</span></label>
                    <textarea name="introduction" id="introduction" rows="5" class="form-control">{{old('introduction', $promotion->introduction)}}</textarea>
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
                        @if($promotion->photo)
                        <img src="{{$promotion->photo}}" class="img-lg"  alt="Promotion image">
                        @else
                        <i class="fa-solid fa-image text-secondary icon-xl d-block text-center"></i>
                        @endif
                    </div>
                </div>     
            </div>
            <div class="row">
                <div class="col">
                    <input type="file" name="photo" id="" class="form-control form-control-sm w-100 mb-auto p-2" >
                    @error('photo')
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
                    <a href="{{route('profile.posts', Auth::user()->id)}}">
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