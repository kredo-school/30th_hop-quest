@extends('layouts.app')
    
@section('title', 'Add A Business - Location or Event')
    
@section('content')
<div class="bg-blue">
    <div class="row justify-content-center pt-5">
        <form action="{{ route('business.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
            
                @if ($errors->any())
                    <div style="color: red">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


            <div class="col-md-10 col-lg-8 box-border mx-auto" >

                <div class="col">
                    <h4 class=" d-inline me-3">Add A Business Location or Event</h4>
                    <p class="form-label d-inline ">(<span class="color-red fw-bold">*</span> Required items for official certification)<p>
                </div>
                    
                <!-- プルダウンメニュー -->
                <div class="row">
                    <div class="col mb-3">
                        <label for="category_id" class="form-label d-inline">
                            Choose one <span class="text-danger fw-bold">*</span>
                        </label>
                        <select class="form-control w-25" id="category_id" name="category_id">
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>----------</option>
                            <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>Location</option>
                            <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>Event</option>
                        </select>
                    </div>
                </div>
                
                <!-- Location or Event Details -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label" id="name-label">Event Name<span style="color: #D24848;">*</span></label>
                            <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control">
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
                        <!-- Business Email -->
                        <div class="col-6 mb-3">
                            <label for="email" class="d-inline me-3 form-label">
                                Business email<span style="color:#D24848;">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{old('email')}}" class="form-control">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="website_url" class="form-label d-inline">Official website URL: Please include https://</label>
                            <input
                                type="url"
                                name="website_url"
                                id="website_url"
                                class="form-control"
                                placeholder="https://example.com"
                                value="{{ old('website_url') }}"
                            >
                        </div>
                        
                        @push('scripts')
                        <script>
                            document.addEventListener('DOMContentLoaded', function () {

                                const websiteInput = document.querySelector('input[name="website_url"]');
        if (websiteInput && websiteInput.value === '') {
            websiteInput.value = 'https://';
        }

        document.querySelector('form').addEventListener('submit', function () {
            let urlField = document.querySelector('input[name="website_url"]');
            if (urlField.value && !urlField.value.startsWith('http://') && !urlField.value.startsWith('https://')) {
                urlField.value = 'https://' + urlField.value;
                                    }
                                });
                            });
                        </script>
                        @endpush
                        
                    </div>
                    
                    <div class="row">
                        <div class="col mb-3">
                            <label for="zip" class="form-label">Zip Code<span style="color: #D24848;">*</span></label>
                            <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip') }}">
                            @error('zip')
                            <p class="mb-0 text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                        <!-- Phone Number -->
                        <div class="col-6 mb-3">
                            <label for="phonenumber" class="form-label">
                                Phone number<span style="color:#D24848;">*</span>
                            </label>
                            <input type="tel" id="phonenumber" name="phonenumber" class="form-control" placeholder="+ Country code and phone number" value="{{ old('phonenumber') }}">
                            @error('phonenumber')
                            <p class="mb-0 text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col mb-3">
                            <label for="address_1" class="form-label">Address 1<span style="color: #D24848;">*</span>Alphabetical notation</label>
                            <input type="text" name="address_1" id="address_1" class="form-control" value="{{ old('address_1') }}">
                            @error('address_1')
                            <p class="mb-0 text-danger small">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-3">
                            <label for="address_2" class="form-label">Address 2: Notation in local language</label>
                            <input type="text" name="address_2" id="address_2" class="form-control" value="{{ old('address_2') }}">
                        </div>
                    </div>
                    
                <!-- Introduction / Message -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="introduction" class="form-label">
                            Introduction<span style="color: #D24848;">*</span>
                        </label>
                        <textarea 
                            name="introduction" 
                            id="introduction" 
                            class="form-control" 
                            rows="5"
                        >{{ old('introduction') }}</textarea>
                    </div>
                </div>

                {{-- main_image --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="main_image" class="form-label">Upload Main Photo</label>
                        <input type="file" name="main_image" id="main_image" class="form-control form-control-sm w-100 mb-auto p-2" >
                    </div>
                </div>

                <!-- 店が開いているかのステータス（ラジオボタン形式・横並び） -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label fw-bold d-block">Business Status <span style="color: #808080;">(If you select "Close" or "No-information," the Start date and End date within Business Event or Location Period, Special notes, and Business Hours will become unavailable for input.)</span></label>
                        <div class="d-flex flex-wrap gap-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Active" id="status_active"
                                    {{ old('status') == 'Active' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_active">Active</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Close" id="status_close"
                                    {{ old('status') == 'Close' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_close">Close</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="No-information" id="status_noinfo"
                                    {{ old('status') == 'No-information' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_noinfo">No-information</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" value="Coming Soon" id="status_coming"
                                    {{ old('status') == 'Coming Soon' ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_coming">Coming Soon</label>
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const statusRadios = document.querySelectorAll('input[name="status"]');
                        const disableTargets = [
                            document.getElementById('term_start'),
                            document.getElementById('term_end'),
                            document.getElementById('sp_notes'),
                            ...document.querySelectorAll('input[type="time"]'),
                            ...document.querySelectorAll('input[type="text"][id$="_notice"]')
                        ];
                
                        function toggleDisabledFields() {
                            const selectedStatus = document.querySelector('input[name="status"]:checked')?.value;
                
                            const shouldDisable = selectedStatus === 'Close' || selectedStatus === 'No-information';
                
                            disableTargets.forEach(el => {
                                if (el) {
                                    el.disabled = shouldDisable;
                                }
                            });
                        }
                
                        // 初期化
                        toggleDisabledFields();
                
                        // イベントリスナーを各ラジオボタンに設定
                        statusRadios.forEach(radio => {
                            radio.addEventListener('change', toggleDisabledFields);
                        });
                    });
                </script>

                <!-- Business Hours & Event Time Periods -->
                <div class="row">
                    <div class="mb-2">
                        <h3 class="text-xl font-bold mb-3">Business Hours & Event Time Periods</h3>

                        <!-- Business Event period -->
                        <div class="mb-1">
                            <label class="form-label font-bold mb-1">Business Event or Location Period</label> 
                                <div class="row">
                                    <div class="col-6">
                                        <label for="term_start" class="form-label">Start date</label>
                                        <input type="date" name="term_start" id="term_start" class="form-control" value="{{ old('term_start') }}">
                                    </div>
                                    <div class="col-6">
                                        <label for="term_end" class="form-label">End date</label>
                                        <input type="date" name="term_end" id="term_end" class="form-control" value="{{ old('term_end') }}">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                    <!-- Special notes -->
                <div class="row">
                    <div class="mb-3">
                        <label for="sp_notes" class="form-label font-bold">Special notes</label>
                        <textarea name="sp_notes" id="sp_notes" class="form-control" rows="3">{{ old('sp_notes') }}</textarea>
                    </div>
                </div>
               <!-- Detailed Weekly Schedule (based on ERD) -->
               <label class="form-label font-bold mb-1">Business Hours</label> 
               <div class="row">
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
                </div>

                <!-- Facility Details -->
                <label class="form-label font-bold mb-1">Facility Details</label>
                <div class="row">
                    <div class="accordion mb-4" id="detailsAccordion">
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
                                    'Credit cards accepted', 'Google Pay and Apple Pay', 'Cash only', 'Cash accepted',
                                    'Visa and Mastercard contactless payment', 'bitcoin payment'
                                ],
                                'Smoking Policy' => [
                                    'Completely non-smoking', 'Smoking area available',
                                    'Designated smoking rooms', 'Outdoor smoking section',
                                    'Smoking permitted throughout'
                                ],
                            ];
                        @endphp

                        @foreach($amenities as $category => $options)
                            @php $index = $loop->index; @endphp
                            <div class="accordion-item">
                                <div class="accordion-header" id="headingDetail{{ $index }}">
                                    <div class="row">
                                        <div class="col-2">
                                            <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapseDetail{{ $index }}"
                                                    aria-expanded="false"
                                                    aria-controls="collapseDetail{{ $index }}">
                                                {{ $category }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="collapseDetail{{ $index }}" class="accordion-collapse collapse"
                                    aria-labelledby="headingDetail{{ $index }}" data-bs-parent="#detailsAccordion">
                                    <div class="accordion-body">
                                        <div class="row">
                                            @foreach($options as $option)
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            type="checkbox"
                                                            id="{{ Str::slug($option, '_') }}"
                                                            name="details[{{ $category }}][]"
                                                            value="{{ $option }}"
                                                             {{ is_array(old("details.$category")) && in_array($option, old("details.$category")) ? 'checked' : '' }}>>
                                                        <label class="form-check-label"
                                                            for="{{ Str::slug($option, '_') }}">{{ $option }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
   

                <!-- Identification Information-->
                <label class="form-label font-bold mb-1">Identification Information</label> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4">
                                <span style="color: #D24848;">*</span>
                                Please provide official Location of business or Event identification information.<br>
                                This helps verify your business or event and build trust with customers.
                                <div class="col-md-8 px-0">
                                    <input type="text"
                                        id="identification_number"
                                        name="identification_number"
                                        class="form-control"
                                        placeholder="Enter your business license number or event permit number here." value="{{ old('identification_number') }}">
                                </div>   
                        </div>
                    </div>
                </div> 

                <!-- Business/Event photos -->
                <div class="col-md-12">
                    <div class="mb-4 p-4 border rounded bg-light">
                        <h4 class="font-bold mb-3">Business/Event photos</h4>
                        <div class="row">
                            @for ($i = 1; $i <= 3; $i++)
                            <div class="col-md-4 mb-3 text-center">
                                <div class="position-relative">
                                    <div class="photo-preview" id="preview_{{ $i }}">
                                        <label for="image_{{ $i }}" class="form-label d-block font-bold">
                                            @if($i === 1) 1st Photo @elseif($i === 2) 2nd Photo @else 3rd Photo @endif
                                        </label>
                                        <input type="file"
                                            id="image_{{ $i }}"
                                            name="images[]"
                                            class="form-control image-input"
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

                <!-- Display Period -->
                <div class="row">
                    <div class="col-md-14">
                    <div class="accordion mb-4" style="padding: 1.5rem; background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: .5rem;">
                        <h4 class="font-bold mb-3">Display Period</h4>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="display_start" class="form-label">Start date</label>
                                <input type="date" id="display_start" name="display_start" class="form-control" value="{{ old('display_start') }}">
                            </div>
                            <div class="col-md-6">
                                <label for="display_end" class="form-label">End date</label>
                                <input type="date" id="display_end" name="display_end" class="form-control" value="{{ old('display_end') }}">
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
                    <div class="col-md-14">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-4 ">
                            <button type="submit" id="save-button" class="btn btn-green w-100 mb-2">SAVE</button>
                            <input type="checkbox" class="form-check-input mb-2" name="official_certification" id="official_certification" value="1" {{ old('official_certification', Auth::user()->official_certification) ? 'unchecked' : '' }}> Apply for Official certification badge
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