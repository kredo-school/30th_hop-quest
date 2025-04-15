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
                <script src="{{ asset('js/business.js') }}"></script>

                <!-- Contact Information Form -->
                @include('businessusers.posts.businesses.partials.contact-information')

                <!-- social-media -->
                @include('businessusers.posts.businesses.partials.social-media')

                <!-- Business Status -->
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Business Status<span class="text-danger">*</span></label>
                        <div class="d-flex flex-wrap gap-4 py-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-open" value="Open" {{ old('status', $business->status ?? '') == 'Open' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-open">
                                    Open
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-coming-soon" value="Coming Soon" {{ old('status', $business->status ?? '') == 'Coming Soon' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-coming-soon">
                                    Coming Soon
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-unknown" value="Unknown" {{ old('status', $business->status ?? '') == 'Unknown' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-unknown">
                                    Unknown
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status-closed" value="Closed" {{ old('status', $business->status ?? '') == 'Closed' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status-closed">
                                    Closed
                                </label>
                            </div>
                        </div>
                        @error('status')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

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