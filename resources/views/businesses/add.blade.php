@extends('layouts.app')
    
@section('title', 'Add A Business - Location or Event')
    
@section('content')
<div class="bg-blue">
    <div class="row justify-content-center pt-5">
        <form action="{{route('business.store')}}" method="post" enctype="multipart/form-data">
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
                    
                    <div class="row">
                        <div class="col mb-3">
                            <label for="zip" class="form-label">Zip Code<span style="color: #D24848;">*</span></label>
                            <input type="text" name="zip" id="zip" class="form-control" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="address" class="form-label">Address 1<span style="color: #D24848;">*</span></label>
                            <input type="text" name="address" id="address" class="form-control" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="address2" class="form-label">Address 2</label>
                            <input type="text" name="address2" id="address2" class="form-control">
                        </div>
                    </div>
                    <!-- Social Media -->
                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Social Media</label>
                            <div class="row mb-3">
                                <!-- Instagram -->
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <div class="pe-0">
                                            <i class="fa-brands fa-square-instagram fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ps-2">
                                            <input type="text" name="instagram" class="form-control" placeholder="Instagram URL">
                                        </div>
                                    </div>
                                </div>
                                <!-- Facebook -->
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="pe-0">
                                            <i class="fa-brands fa-square-facebook fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ps-2">
                                            <input type="text" name="facebook" class="form-control" placeholder="Facebook URL">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <!-- Twitter/X -->
                                <div class="col-md-6 mb-2 mb-md-0">
                                    <div class="d-flex align-items-center">
                                        <div class="pe-0">
                                            <i class="fa-brands fa-square-x-twitter fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ps-2">
                                            <input type="text" name="x" class="form-control" placeholder="X/Twitter URL">
                                        </div>
                                    </div>
                                </div>
                                <!-- TikTok -->
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center">
                                        <div class="pe-0">
                                            <i class="fa-brands fa-tiktok fa-2x"></i>
                                        </div>
                                        <div class="flex-grow-1 ps-2">
                                            <input type="text" name="tiktok" class="form-control" placeholder="TikTok URL">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{-- <!-- Official Website -->
                <div class="mb-3">
                    <label for="website_url" class="form-label">Official website URL</label>
                    <input type="text" name="website_url" id="website_url" class="form-control">
                </div> --}}

                <!-- Welcome message -->
                <div class="row">
                    <div class="col mb-3">
                        <label for="introduction" class="form-label">
                            Welcome message<span style="color: #D24848;">*</span>
                        </label>
                        <textarea 
                            name="introduction" 
                            id="introduction" 
                            class="form-control" 
                            rows="5"
                        ></textarea>
                    </div>
                </div>
                <!-- Business Hours & Event Time Periods -->
                <div class="row">
                    <div class="mb-2">
                        <h3 class="text-xl font-bold mb-3">Business Hours & Event Time Periods</h3>

                        <!-- Business Event period -->
                        <div class="mb-1">
                            <label class="form-label font-bold mb-1">Business Event period</label> 
                                <div class="row mt-0">
                                    <div class="col">
                                        <label for="term_start" class="form-label">Start date</label>
                                        <input type="date" name="term_start" id="term_start" class="form-control">
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="term_end" class="form-label">End date</label>
                                    <input type="date" name="term_end" id="term_end" class="form-control">
                                </div>
                        </div>
                    </div>
                </div>
                    <!-- Special notes -->
                <div class="row">
                    <div class="mb-3">
                        <label for="sp_notes" class="form-label font-bold">Special notes</label>
                        <textarea name="sp_notes" id="sp_notes" class="form-control" rows="3"></textarea>
                    </div>
                </div>
               <!-- Detailed Weekly Schedule (based on ERD) -->
               <div class="row">
                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                    <div class="mb-4 p-4 border rounded bg-light">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="font-bold">{{ $day }}</h5>
                        <div class="form-check">
                            <input type="checkbox" id="{{ strtolower($day) }}_is_closed" name="business_hours[{{ $day }}][is_closed]" class="form-check-input">
                            <label class="form-check-label ms-2" for="{{ strtolower($day) }}_is_closed">Closed</label>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="{{ strtolower($day) }}_opening_time" class="form-label">Opening time</label>
                            <input type="time" id="{{ strtolower($day) }}_opening_time" name="business_hours[{{ $day }}][opening_time]" class="form-control">
                        </div>
                        <div class="col">
                            <label for="{{ strtolower($day) }}_closing_time" class="form-label">Closing time</label>
                            <input type="time" id="{{ strtolower($day) }}_closing_time" name="business_hours[{{ $day }}][closing_time]" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="col">
                            <label for="{{ strtolower($day) }}_break_start" class="form-label">Break start</label>
                            <input type="time" id="{{ strtolower($day) }}_break_start" name="business_hours[{{ $day }}][break_start]" class="form-control">
                        </div>
                        <div class="col">
                            <label for="{{ strtolower($day) }}_break_end" class="form-label">Break end</label>
                            <input type="time" id="{{ strtolower($day) }}_break_end" name="business_hours[{{ $day }}][break_end]" class="form-control">
                        </div>
                    </div>

                    <div class="mb-2">
                        <label for="{{ strtolower($day) }}_notice" class="form-label">Notes</label>
                        <input type="text" id="{{ strtolower($day) }}_notice" name="business_hours[{{ $day }}][notice]" class="form-control" placeholder="Example Last order 40 minutes before closing">
                    </div>
                    </div>
                @endforeach
                </div>
                <!-- Business Amenities Form -->
                <div class="row">
                    <div class="mb-4 p-4 border rounded bg-light">
                        <h4 class="font-bold mb-3">Detailes</h4>
                        @php
                            $amenities = [
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

                        @foreach ($amenities as $category => $items)
                            <div class="mb-3">
                                <hr>
                                <h5 class="font-bold">{{ $category }}</h5>
                                <div class="row px-4">
                                    @foreach ($items as $item)
                                        <div class="col-md-6 form-check">
                                            <input type="checkbox"
                                                class="form-check-input"
                                                id="{{ Str::slug($item) }}"
                                                name="amenities[]"
                                                value="{{ $item }}">
                                            <label class="form-check-label" for="{{ Str::slug($item) }}">{{ $item }}</label>
                                        </div>
                                        
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Identification Information-->
                <div class="row">
                    <div class="mb-4 p-4 border rounded bg-light">
                        <h4 class="font-bold mb-3">Identification Information</h4>
                        <div class="mt-2 mb-3">
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
                    </div>
                </div>
                <!-- Contact Information Form -->
                <div class="row">
                    <div class="mb-4 p-4 border rounded bg-light">
                        <h4 class="font-bold mb-3">Contact information</h4>

                        <!-- Business Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Business email (No-display to publicity)<span style="color:#D24848;">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-3">
                            <label for="phonenumber" class="form-label">
                                Phone number<span style="color:#D24848;">*</span>
                            </label>
                            <input type="tel" id="phonenumber" name="phonenumber" class="form-control" placeholder="+ Country code and phone number">
                        </div>
                    </div>
                </div>
                <!-- Business/Event photos -->
                <div class="row">
                    <div class="mb-4 p-4 border rounded bg-light">
                        <h4 class="font-bold mb-3">Business/Event photos</h4>
                        <div class="row">
                            @for ($i = 1; $i <= 3; $i++)
                            <div class="col-md-4 mb-3 text-center">
                                <div class="position-relative">
                                    <div class="photo-preview" id="preview_{{ $i }}">
                                        <label for="photo_{{ $i }}" class="form-label d-block font-bold">
                                            @if($i === 1) 1st Photo @elseif($i === 2) 2nd Photo @else 3rd Photo @endif
                                        </label>
                                        <input type="file"
                                            id="photo_{{ $i }}"
                                            name="photos[{{ $i }}]"
                                            class="form-control photo-input"
                                            accept="image/*">
                                        @if($i === 1)
                                            <small class="text-muted">(Main Photo)</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
                <!-- Term for display to public this location/event -->
                <div class="row">
                    <div class="mb-4 p-4 border rounded bg-light">
                        <h4 class="font-bold mb-3">Display Period</h4>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="display_start" class="form-label">Start date</label>
                                <input type="date" id="display_start" name="display_start" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="display_end" class="form-label">End date</label>
                                <input type="date" id="display_end" name="display_end" class="form-control">
                            </div>
                        </div>

                        <div class="text-danger" style="color:#D24848; line-height: 1.2;">
                            <p class="mb-1">* No setting start date will be "no publish to user."</p>
                            <p class="mb-1">* No setting start and end date will be "no publish to user."</p>
                            <p class="mb-0">* Setting start and no end date will be "no limit date to publish to user."</p>
                        </div>
                        
                    </div>
                </div>
                <!-- Submission Buttons -->
                <div class="row">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-4 ">
                            <button type="submit" class="btn btn-green w-100 mb-2">SAVE</button>
                            <input type="checkbox" class="form-check-input mb-2" name="" id="" value=""> Apply for Official certification badge
                        </div>
                        <div class="col-2"></div>
                        <div class="col-4 ">
                            <a href="{{route('profile')}}">
                                <button class="btn btn-red w-100 ">CANCEL</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>       
    </div>
</div>
@endsection