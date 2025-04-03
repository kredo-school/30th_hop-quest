@extends('layouts.app')
    
@section('title', 'Create Model Quest')
    
@section('content')
<div class="bg-blue">
    <div class="row justify-content-center pt-5">
        <form action="{{route('quests.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            
            <div class="col-md-10 col-lg-8 box-border mx-auto" >

                <div class="row mb-3">
                    <div class="col">
                        <h4 class=" d-inline me-3">Add a Model Quest</h4>
                        <p class="form-label d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                    </div>
                </div>
                
                <!-- Location or Event Details -->
                <div class="row">
                    <div class="col mb-3">
                        <label for="title" class="form-label" id="name-label">Name<span style="color: #D24848;">*</span></label>
                        <input type="text" name="title" id="title" class="form-control">
                    </div>
                </div>
            
            {{-- Duration --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="duration" class="form-label">Duration<span class="color-red">*</span></label>
                    <input type="number" name="duration" id="duration" class="form-control w-25">
                    {{-- @error('duration')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror --}}
                </div>    
            </div>

            {{-- Introduction --}}
            <div class="row mb-3">
                <div class="col">
                    <label for="introduction" class="form-label">Introduction<span class="color-red">*</span></label>
                    <textarea name="introduction" id="introduction" rows="3" class="form-control"></textarea>
                    @error('introduction')
                    <p class="mb-0 text-danger small">{{ $message }}</p>
                    @enderror
                </div>    
            </div>

                {{-- images --}}
                <div class="row">
                    <label for="main_photo" class="form-label">Upload Main Photo</label>
                
                    <!-- Priority 1 -->
                    <div class="col-md-4">
                        <label for="main_image"></label>
                        <input type="file" name="main_image" id="main_image" class="form-control">
                    </div>
                
                </div>
                
            <!-- Submission Buttons -->
                <div class="row">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-4 ">
                            <button type="submit" class="btn btn-green w-100 mb-2">SAVE</button>
                            {{-- <input type="checkbox" class="form-check-input mb-2" name="" id="" value=""> Apply for Official certification badge --}}
                        </div>
                        <div class="col-2"></div>
                        <div class="col-4 ">
                            <a href="{{route('profile.quests', Auth::user()->id)}}">
                                <div class="btn btn-red w-100 ">CANCEL</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>       
    </div>
</div>
@endsection