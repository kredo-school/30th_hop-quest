@extends('layouts.app')
    
@section('title', 'Add A Business - Location or Event')
    
@section('content')
<div class="bg-blue">
    <div class="row justify-content-center pt-5 pb-5">
        <form method="POST" action="{{ route('businesses.store') }}" enctype="multipart/form-data">
                @csrf
            
            <div class="col-md-10 col-lg-8 box-border mx-auto" >

                <div class="row mb-3">
                    <div class="col">
                        <h4 class="d-inline me-3">Add A Business Location or Event</h4>
                        <p class="form-label d-inline">(<span class="color-red fw-bold">*</span> Required items)</p>
                    </div>
                </div>

                <!-- Pull-down Menu --> 
                <div class="row">
                    <div class="col mb-3">
                        <label for="category_id" class="form-label d-inline">
                            Choose one <span class="text-danger fw-bold">*</span>
                        </label>
                        <select class="form-control w-25" id="category_id" name="category_id">
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>----------</option>
                            <option value="1" {{ old('category_id') == '1' ? 'selected' : '' }}>Location</option>
                            <option value="2" {{ old('category_id') == '2' ? 'selected' : '' }}>Event</option>
                        </select>
                    </div>
                </div>
                
                <!-- Location or Event Details -->
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label" id="name-label">
                            <span id="detail-type">{{ old('category_id') == 2 ? 'Event' : 'Location' }}</span> Name<span style="color: #D24848;">*</span>
                        </label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control">
                    </div>
                </div>
                {{-- @push('scripts') --}}
                <!-- JavaScript -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var select = document.getElementById("category_id"); 
                        var label = document.getElementById("name-label");

                        // 初期表示時にも選択されていれば変更
                        updateLabel();
                        
                        select.addEventListener("change", function() {
                            updateLabel();
                        });

                        function updateLabel() {
                            if (select.value == "1") {
                                label.innerHTML = "Location Name<span class='text-danger'>*</span>";
                            } else if (select.value == "2") {
                                label.innerHTML = "Event Name<span class='text-danger'>*</span>";
                            }
                        }
                    });
                </script>
                
                <!-- Contact Information Form -->
                @include('businessusers.posts.businesses.partials.contact-information')

                <!-- social-media -->
                @include('businessusers.posts.businesses.partials.social-media')

                {{-- Introduction --}}
                <div class="row">
                    <div class="col mb-3">
                        <label for="introduction" class="form-label">Introduction</label>
                        <textarea name="introduction" id="introduction" class="form-control @error('introduction') is-invalid @enderror" rows="4">{{ old('introduction') }}</textarea>
                        @error('introduction')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- main_image -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="main_image" class="form-label">Upload Main Photo</label>
                        <input type="file" name="main_image" id="main_image" class="form-control form-control-sm w-100 mb-auto p-2 is-invalid">
                        @error('main_image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>                
                </div>

                <!-- Business Term Info and S.P.Notes -->
                @include('businessusers.posts.businesses.partials.business-hours')
                
                <!-- Weekly Business Schedule' -->
                @include('businessusers.posts.businesses.partials.weekly-schedule')
                
                <!-- Facility information -->
                {{-- @include('businessusers.posts.businesses.partials.business-details-facility', ['businessDetail' => $businessDetail ?? null, 'oldValues' => old('details')]) --}}

                <!-- Identification Information -->
                @include('businessusers.posts.businesses.partials.identification-information', ['business' => $business ?? null])
                
                {{-- business-photos --}}
                @include('businessusers.posts.businesses.partials.business-photos')

                <!-- Term for display to public this location/event -->
                @include('businessusers.posts.businesses.partials.display-period', ['business' => $business ?? null])

                <!-- Submission Buttons -->
                @include('businessusers.posts.businesses.partials.submission-buttons', [
                    'business' => $business ?? null,
                    'submitButtonText' => isset($business) ? 'UPDATE' : 'SAVE'
                ])
            </div>
        </form>       
    </div>
</div>
@endsection