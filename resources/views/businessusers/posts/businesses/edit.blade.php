@extends('layouts.app')

@section('title', 'Edit A Business - Location or Event')

@section('content')
    <link rel="stylesheet" href="{{asset('css/style.css')}}"  /> 
    <div class="bg-blue">
        <main>
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 box-border mx-auto" style="background-color: #B4D5F4; border-radius: 0px;">
                    <div class="d-flex mb-3">
                        <div class="col">
                            <h4 class=" d-inline me-3">Edit Business</h4>
                            <p class="form-label d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                        </div>
                        <button type="button" class="btn btn-red col-2 ms-auto" data-bs-toggle="modal" data-bs-target="#deleteBusinessModal">
                            DELETE
                        </button>
                    </div>
                    @include('businessusers.posts.businesses.modals.delete')

                    <form action="{{ route('businesses.update', $business, Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Location or Event Details -->
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>

                            <select class="form-control w-25" id="category_id" name="category_id">
                                <option value="1" {{ (old('category_id', $business->category_id) == 1) ? 'selected' : '' }}>Location</option>
                                <option value="2" {{ (old('category_id', $business->category_id) == 2) ? 'selected' : '' }}>Event</option>
                            </select>
                        </div>

                        <!-- Location or Event Details -->
                        <div class="mb-3">
                            <!-- 現在の選択に基づいて初期表示 -->
                            <label for="name" class="form-label d-inline" id="name-label">
                                {{ (old('category_id', $business->category_id) == 2) ? 'Event' : 'Location' }} Name<span style="color: #D24848;">*</span>
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $business->name ?? '') }}" class="form-control">
                        </div>

                        <script src="{{ asset('js/business.js') }}"></script>

                        <!-- Contact Information Form -->
                        @include('businessusers.posts.businesses.partials.contact-information')

                        {{-- main_image --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="main_image" class="form-label">Upload Main Photo</label>
                                <img src="{{$business->main_image}}" alt="" class="d-block img-lg mb-2">
                                <input type="file" name="main_image" id="main_image" class="form-control form-control-sm w-100 mb-auto p-2" >
                            </div>                
                        </div>

                        <!-- social-media -->
                        @include('businessusers.posts.businesses.partials.social-media')

                        <!-- Introduction -->
                        <div class="mb-3">
                            <label for="introduction" class="form-label d-inline">
                                Introduction<span style="color: #D24848;">*</span>
                            </label>
                            <textarea name="introduction" class="form-control">{{ old('introduction', $business->introduction ?? '') }}</textarea>
                        </div>

                        <h3 class="text-xl font-bold mb-3">Business Hours & Event Time Periods</h3>

                        <!-- Business Location or Event Term Info and S.P.Notes -->
                        @include('businessusers.posts.businesses.partials.business-status')

                        <!-- Weekly Business Schedule' -->
                        @include('businessusers.posts.businesses.partials.weekly-schedule')

                        <!-- Facility information -->
                        @include('businessusers.posts.businesses.partials.business-details', ['businessDetail' => $businessDetail ?? null, 'oldValues' => old('details')])

                        <!-- Identification Information -->
                        @include('businessusers.posts.businesses.partials.identification-information', ['business' => $business ?? null])

                        <!-- business-photos -->
                        @include('businessusers.posts.businesses.partials.business-photos')

                        <!-- Term for display to public this location/event -->
                        @include('businessusers.posts.businesses.partials.display-period', ['business' => $business ?? null])

                        <!-- Submission Buttons -->
                        @include('businessusers.posts.businesses.partials.submission-buttons', [
                            'business' => $business ?? null,
                            'submitButtonText' => isset($business) ? 'UPDATE' : 'SAVE'
                        ])
                    </form>   
                </div>
            </div>
        </main>
    </div>
@endsection
