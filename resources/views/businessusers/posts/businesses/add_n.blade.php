@extends('layouts.app')
    
@section('title', 'Add A Business - Location or Event')
    
@section('content')
<div class="bg-blue">
    <div class="row justify-content-center pt-5 pb-5">
        <form action="{{route('businesses.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            
            <div class="col-md-10 col-lg-8 box-border mx-auto" >

                <div class="row mb-3">
                    <div class="col">
                        <h4 class=" d-inline me-3">Add A Business Location or Event</h4>
                        <p class="form-label d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                    </div>
                </div>

                <!-- プルダウンメニュー --> 
                <div class="row">
                    <div class="col mb-3">
                        <label for="category_id" class="form-label d-inline">
                            Choose one <span class="text-danger fw-bold">*</span>
                        </label>
                        <select class="form-control w-25" id="category_id" name="category_id">
                            <option value="" disabled selected>----------</option>
                            <option value="1">Location</option>
                            <option value="2">Event</option>
                        </select>
                    </div>
                </div>
                
                <!-- Location or Event Details -->
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label" id="name-label">Event Name<span style="color: #D24848;">*</span></label>
                        <input type="text" name="name" id="name" class="form-control">
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
                <div class="row">
                    <!-- Business Email -->
                    <div class="col-6 mb-3">
                        <label for="email" class="d-inline me-3 form-label">
                            Business email<span style="color:#D24848;">*</span>
                        </label>
                        <input type="email" id="email" name="email"  class="form-control">
                    </div>
                    <!-- Official Website -->
                    <div class="col-6 mb-3">
                        <label for="website_url" class="form-label d-inline">Official website URL</label>
                        <input type="text" name="website_url" id="website_url" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <p class="form-label d-inline ">(<span class="color-red fw-bold">**</span> Required items to apply for official certification badge)<p>
                    </div>        
                </div>

                <div class="row">
                    <div class="col-6 mb-3">
                        <label for="zip" class="form-label d-inline">Zip Code<span style="color: #D24848;">**</span></label>
                        <input type="text" name="zip" id="zip" class="form-control" >
                    </div>
                    <!-- Phone Number -->
                    <div class="col-6 mb-3">
                        <label for="phonenumber" class="d-inline me-3 form-label">
                            Phone number<span style="color:#D24848;">**</span>
                        </label>
                        <input type="tel" id="phonenumber" name="phonenumber" class="form-control" placeholder="+ Country code and phone number">
                    </div>
                </div>

                <div class="row">
                    <div class="col mb-3">
                        <label for="address_1" class="form-label">Address 1<span style="color: #D24848;">**</span></label>
                        <input type="text" name="address_1" id="address_1" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="address_2" class="form-label">Address 2</label>
                        <input type="text" name="address_2" id="address_2" class="form-control">
                    </div>
                </div>

                {{-- Introduction --}}
                <div class="row mb-3">
                    <div class="mb-3">
                        <label for="introduction" class="form-label d-inline">
                            Introduction<span style="color: #D24848;">**</span>
                        </label>
                        <textarea 
                            name="introduction" id="introduction" class="form-control" rows="5"></textarea>
                    </div>
                </div>

                {{-- main_image --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="main_image" class="form-label">Upload Main Photo</label>
                        <input type="file" name="main_image" id="main_image" class="form-control form-control-sm w-100 mb-auto p-2" >
                    </div>                
                </div>

                {{-- <!-- Business Hours & Event Time Periods -->
                <div class="mb-2">
                    <h3 class="text-xl font-bold mb-3">Business Hours & Event Time Periods</h3>

                    <!-- Business Event period -->
                    <div class="mb-1">
                        <label class="form-label d-inline">Business Event period</label> 
                            <div class="row mt-0">
                                <div class="col">
                                    <label for="term_start" class="form-label d-inline">Start date</label>
                                <input type="date" name="term_start" id="term_start" class="form-control">
                            </div>

                            <div class="col">
                                <label for="term_end" class="form-label d-inline">End date</label>
                                <input type="date" name="term_end" id="term_end" class="form-control">
                            </div>
                        </div>
                    </div>

                    <!-- Special notes -->
                    <div class="mb-3">
                        <label for="sp_notes" class="form-label d-inline">Special notes</label>
                        <textarea name="sp_notes" id="sp_notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                    
                <!-- Detailed Weekly Schedule (based on ERD) -->
                <div class="accordion mb-3" id="weekdayAccordion">
                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $index => $day)
                        <div class="accordion-item">
                            <div class="accordion-header" id="heading{{ $index }}">
                                <div class="row">
                                <div class="col-2">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false" aria-controls="collapse{{ $index }}">
                                        {{ $day }} 
                                    </button>
                                </div>
                                <div class="col-auto ms-auto me-5 my-auto">
                                    <input type="checkbox" id="{{ strtolower($day) }}_is_closed" name="business_hours[{{ $day }}][is_closed]" class="form-check-input ms-auto">
                                    <label class="form-check-label ms-2 align-self-end" for="{{ strtolower($day) }}_is_closed">Closed</label></div>
                                </div>
                            </div>

                            <div id="collapse{{ $index }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $index }}" data-bs-parent="#weekdayAccordion">
                                <div class="accordion-body">
                                    <!-- 各曜日の入力フォーム -->
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="{{ strtolower($day) }}_opening_time" class="d-inline me-3">Opening time</label>
                                            <input type="time" id="{{ strtolower($day) }}_opening_time" name="business_hours[{{ $day }}][opening_time]" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="{{ strtolower($day) }}_closing_time" class="d-inline me-3">Closing time</label>
                                            <input type="time" id="{{ strtolower($day) }}_closing_time" name="business_hours[{{ $day }}][closing_time]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="{{ strtolower($day) }}_break_start" class="d-inline me-3">Break start</label>
                                            <input type="time" id="{{ strtolower($day) }}_break_start" name="business_hours[{{ $day }}][break_start]" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label for="{{ strtolower($day) }}_break_end" class="d-inline me-3">Break end</label>
                                            <input type="time" id="{{ strtolower($day) }}_break_end" name="business_hours[{{ $day }}][break_end]" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col">
                                            <label for="{{ strtolower($day) }}_notice" class="d-inline me-3">Notes</label>
                                            <input type="text" id="{{ strtolower($day) }}_notice" name="business_hours[{{ $day }}][notice]" class="form-control" placeholder="Example Last order 40 minutes before closing">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Business Facility Detail Form -->
                <div class="mb-4 p-4 border rounded bg-light">
                    <h4 class="form-label d-inline">Detailes</h4>
                    @php
                        $details = [
                            'Accessibility' => [
                                'Wheelchair accessible', 'Elevator access', 'Accessible parking',
                                'Accessible restroom', 'Braille signage', 'Hearing loop system'
                            ],
                            'Facilities' => [
                                'Free Wi-Fi', 'Public restroom', 'Parking available',
                                'Bicycle parking', 'Changing room', 'Shower facilities'
                            ],
                            'Payment Options' => [
                                'Credit cards accepted', 'Google Pay and Apple Pay', 'Cash only',
                                'Visa and Mastercard contactless payment', 'bitcoin payment'
                            ],
                            'Smoking Policy' => [
                                'Completely non-smoking', 'Smoking area available',
                                'Designated smoking rooms', 'Outdoor smoking section',
                                'Smoking permitted throughout'
                            ],
                        ];
                    @endphp

                    @foreach ($details as $category => $items)
                    <div class="mb-3">
                        <hr>
                        <h5 class="font-bold">{{ $category }}</h5>
                        <div class="row px-4">
                            @foreach ($items as $item)
                                <div class="col-md-6 form-check">
                                    <input type="checkbox"
                                        class="form-check-input"
                                        id="{{ Str::slug($category . '-' . $item) }}"
                                        name="details[{{ $category }}][]"
                                        value="{{ $item }}">
                                    <label class="form-check-label" for="{{ Str::slug($category . '-' . $item) }}">{{ $item }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Identification Information-->
                <div class="mb-4 p-4 border rounded bg-light">
                    <h4 class="form-label d-inline">Identification Information</h4>
                    <div class="d-inline me-3">
                        <p class="text-muted">
                            <span style="color: #D24848;">*</span>
                            Please provide official Location of business or Event identification information.<br>
                            This helps verify your business or event and build trust with customers.
                        </p>
                    </div>
                    <input type="text"
                        id="identification_number"
                        name="identification_number"
                        class="form-control">
                </div> --}}
                

                {{-- images --}}
                <div class="mb-4 p-4 border rounded bg-light">
                    <h4 class="form-label d-inline">Business/Event photos</h4>
                    <div class="row">
                        @for ($i = 1; $i <= 3; $i++)
                        <div class="col-md-4 mb-3 text-center">
                            <div class="position-relative">
                                <div class="photo-preview" id="preview_{{ $i }}">
                                    <label class="form-label d-block text-center">Photo {{ $i }}</label>
                                    <input type="file"
                                           id="photo_{{ $i }}"
                                           name="photos[{{ $i }}]"
                                           class="form-control photo-input"
                                           accept="image/*">
                                    <input type="hidden" name="priorities[{{ $i }}]" value="{{ $i }}">
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

               
            <!-- Submission Buttons -->
                <div class="row">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-4 ">
                            <button type="submit" class="btn btn-green w-100 mb-2">SAVE</button>
                            <input type="checkbox" class="form-check-input mb-2" name="official_certification" id="official_certification" value="2" 
                {{ old('official_badge', Auth::user()->official_certification) ? 'unchecked' : '' }}
                > Apply for Official certification badge
                            {{-- <input type="checkbox" class="form-check-input mb-2" name="" id="" value=""> Apply for Official certification badge --}}
                        </div>
                        <div class="col-2"></div>
                        <div class="col-4 ">
                            <a href="{{route('profile.businesses', Auth::user()->id)}}">
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