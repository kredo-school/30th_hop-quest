<div class="bg-blue">
    @extends('layouts.app')
    
    @section('title', 'Edit A Business - Location or Event')
    
    @section('content')
    <link rel="stylesheet" href="{{asset('css/takeshi.style.css')}}"  /> 
        <main>
        <div class="row justify-content-center">
            <form action="{{ route('business.update', ['id' => $business->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')  {{-- PUTメソッドでupdateルートを使用 --}}
                
            <div class="col-md-10 col-lg-8 box-border mx-auto" style="background-color: #B4D5F4; border-radius: 0px;">

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="col">
                        <h4 class=" d-inline me-3">Edit Profile</h4>
                        <p class="form-label d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                    </div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete-category-modal">
                        DELETE
                    </button>
                </div>
                @include('businessusers.businesses.modals.delete')
                
                <!-- プルダウンメニュー -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Choose one <span class="text-danger">*</span></label>
                    
                    <select class="form-control w-25" id="category_id" name="category_id">
                        <option value="1" {{ old('category_id', $business->category_id) == 1 ? 'selected' : '' }}>Location</option>
                        <option value="2" {{ old('category_id', $business->category_id) == 2 ? 'selected' : '' }}>Event</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="name" class="form-label d-inline" id="name-label">Event Name<span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" value="{{ old('name', $business->name) }}" class="form-control">
                </div>
                          
                @push('scripts')
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // --- カテゴリー変更で名称ラベルを変える ---
                        const categorySelect = document.getElementById('category_id');
                        const nameLabel = document.getElementById('name-label');

                        function updateLabel() {
                            if (categorySelect.value === '1') {
                                nameLabel.textContent = 'Location Name';
                            } else if (categorySelect.value === '2') {
                                nameLabel.textContent = 'Event Name';
                            }
                        }

                        updateLabel(); // 初期表示
                        categorySelect.addEventListener('change', updateLabel); // 選択変更時


                        // --- 画像即時プレビュー機能 ---
                        const photoInputs = document.querySelectorAll('.photo-input');

                        photoInputs.forEach(input => {
                            input.addEventListener('change', function () {
                                const index = this.id.split('_')[1];
                                const previewContainer = document.getElementById(`preview_${index}`);

                                if (this.files && this.files[0]) {
                                    const reader = new FileReader();
                                    reader.onload = function (e) {
                                        let img = previewContainer.querySelector('img');
                                        if (!img) {
                                            img = document.createElement('img');
                                            img.style.maxWidth = '100%';
                                            img.style.marginTop = '10px';
                                            previewContainer.appendChild(img);
                                        }
                                        img.src = e.target.result;
                                    };
                                    reader.readAsDataURL(this.files[0]);
                                }
                            });
                        });


                        // --- Business Status に応じて一部項目を非活性化 ---
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

                        toggleDisabledFields(); // 初期状態でチェックして設定

                        statusRadios.forEach(radio => {
                            radio.addEventListener('change', toggleDisabledFields);
                        });
                    });
                </script>
                @endpush

                
                <!-- Contact Information Form -->
                <div class="row">
                    <!-- Business Email -->
                    <div class="col-6 mb-3">
                        <label for="email" class="d-inline me-3 form-label">
                            Business email<span style="color:#D24848;">*</span>
                        </label>
                        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $business->email) }}">

                    </div>
                    <!-- Official Website -->
                    <div class="col-6 mb-3">
                        <label for="website_url" class="form-label d-inline">Official website URL: Please include https://</label>
                        <input type="text" name="website_url" id="website_url" class="form-control" value="{{ old('website_url', $business->website_url) }}">
                    </div>
                </div>
                
                <div class="mb-3">
                    <label for="zip" class="form-label d-inline">Zip Code<span style="color: #D24848;">*</span></label>
                    <input type="text" name="zip" id="zip" class="form-control" value="{{ old('zip', $business->zip) }}">
                </div>

                <div class="mb-3">
                    <label for="address1" class="form-label d-inline">Address 1<span style="color: #D24848;">*</span></label>
                    <input type="text" name="address_1" id="address_1" class="form-control" value="{{ old('address_1', $business->address1) }}">

                </div>
                
                <div class="mb-3">
                    <label for="address2" class="form-label d-inline">Address 2</label>
                    <input type="text" name="address_2" id="address_2" class="form-control" value="{{ old('address_2', $business->address2) }}">
                </div>

                <!-- Welcome message -->
                <div class="mb-3">
                    <label for="introduction" class="form-label d-inline">
                        Introduction<span style="color: #D24848;">*</span>
                    </label>
                    <textarea name="introduction" id="introduction" class="form-control" rows="5">{{ old('introduction', $business->introduction) }}</textarea>
                </div>

                <!-- Business/Event main photo -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="main_image" class="form-label">Upload Main Photo</label>
                        <input type="file" name="main_image" id="main_image" class="form-control form-control-sm w-100 mb-auto p-2">
                        @if ($business->main_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $business->main_image) }}" alt="Main Photo" style="max-width: 100%;">
                            </div>
                        @endif
                    </div>
                </div>       
                
                <!-- Business Status -->
                <div class="mb-3">
                    <label class="form-label fw-bold d-block">
                        Business Status 
                        <span style="color: #808080;">(If you select "Close" or "No-information," Start/End Date, Special Notes, and Business Hours will become disabled)</span>
                    </label>
                    <div class="d-flex flex-wrap gap-4">
                        @php
                            $statuses = ['Active', 'Close', 'No-information', 'Coming Soon'];
                        @endphp
                        @foreach ($statuses as $status)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="status" id="status_{{ strtolower(str_replace(' ', '_', $status)) }}"
                                    value="{{ $status }}"
                                    {{ old('status', $business->status) === $status ? 'checked' : '' }}>
                                <label class="form-check-label" for="status_{{ strtolower(str_replace(' ', '_', $status)) }}">
                                    {{ $status }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                    <!-- Social Media -->
                    <div class="mb-3">
                        <label class="form-label d-inline">Social Media</label>
                        <div class="row mb-3">
                    <!-- Instagram -->
                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="d-flex align-items-center">
                                    <div class="pe-0">
                                        <i class="fa-brands fa-square-instagram fa-2x"></i>
                                    </div>
                                    <div class="flex-grow-1 ps-2">
                                        <input type="text" name="instagram" class="form-control" placeholder="Instagram URL" value="{{ old('instagram', $business->instagram) }}">
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
                                <input type="text" name="facebook" class="form-control" placeholder="Facebook URL" value="{{ old('facebook', $business->facebook) }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- X -->
                    <div class="col-md-6 mb-2 mb-md-0">
                        <div class="d-flex align-items-center">
                            <div class="pe-0">
                                <i class="fa-brands fa-square-x-twitter fa-2x"></i>
                            </div>
                            <div class="flex-grow-1 ps-2">
                                <input type="text" name="twitter_url" class="form-control" placeholder="X URL" value="{{ old('x', $business->x) }}">

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
                                <input type="text" name="twitter_url" class="form-control" placeholder="X/Twitter URL" value="{{ old('twitter_url', $business->twitter_url) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <!-- Business Hours & Event Time Periods -->
                <div class="mb-2">
                    <h3 class="text-xl font-bold mb-3">Business Hours & Event Time Periods</h3>

                    <!-- Business Event period -->
                    <div class="mb-1">
                        <label class="form-label d-inline">Business Event or Location Period</label> 
                            <div class="row mt-0">
                                <div class="col">
                                    <label for="term_start" class="form-label d-inline">Start date</label>
                                    <input type="date" name="term_start" id="term_start" class="form-control" value="{{ old('term_start', $business->term_start) }}">
                            </div>

                            <div class="col">
                                <label for="term_end" class="form-label d-inline">End date</label>
                                <input type="date" name="term_end" id="term_end" class="form-control" value="{{ old('term_end', $business->term_end) }}">
                            </div>
                        </div>
                    </div>

                    <!-- Special notes -->
                    <div class="mb-3">
                        <label for="sp_notes" class="form-label d-inline">Special notes</label>
                        <textarea name="sp_notes" id="sp_notes" class="form-control" rows="3">{{ old('sp_notes', $business->sp_notes) }}</textarea>
                    </div>
                </div>
                
               <!-- Detailed Weekly Schedule (based on ERD) -->
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

                    <div class="mb-2">
                        <label for="{{ strtolower($day) }}_notice" class="d-inline me-3">Notes</label>
                        <input type="text" id="{{ strtolower($day) }}_notice" name="business_hours[{{ $day }}][notice]" class="form-control" placeholder="Example Last order 40 minutes before closing">
                    </div>
                </div>
                @endforeach

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
                                'Credit cards accepted', 'Google Pay and Apple Pay', 'Cash only','Cash accepted',
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
                                        id="{{ Str::slug($item) }}"
                                        name="details[]"
                                        value="{{ $item }}"
                                        {{ in_array($item, old('details', $existingDetails ?? [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="{{ Str::slug($item) }}">{{ $item }}</label>
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
                    <input type="text" id="identification_number" name="identification_number" class="form-control" value="{{ old('identification_number', $business->identification_number) }}">

                </div>

                <!-- Contact Information Form -->
            <div class="mb-4 p-4 border rounded bg-light">
                <h4 class="form-label d-inline">Contact information</h4>

                <!-- Phone Number -->
                <div class="mb-3">
                    <label for="phonenumber" class="d-inline me-3">
                         Phone number<span style="color:#D24848;">*</span>
                    </label>
                    <input type="tel" id="phonenumber" name="phonenumber" class="form-control" placeholder="+ Country code and phone number" value="{{ old('phonenumber', $business->phonenumber) }}">
                </div>
            </div>

                <!-- Business/Event photos -->
                <div class="mb-4 p-4 border rounded bg-light">
                    <h4 class="form-label d-inline">Business/Event photos</h4>
                    <div class="row">
                        @for ($i = 1; $i <= 3; $i++)
                        <div class="col-md-4 mb-3 text-center">
                            <div class="position-relative">
                                <div class="photo-preview" id="preview_{{ $i }}">
                                    <label for="photo_{{ $i }}" class="d-inline me-3 d-block font-bold">
                                        @if($i === 1) 1st Photo @elseif($i === 2) 2nd Photo @else 3rd Photo @endif
                                    </label>
                                    <input type="file"
                                        id="photo_{{ $i }}"
                                        name="photos[{{ $i }}]"
                                        class="form-control photo-input"
                                        accept="image/*">
                                    @if(isset($photoUrls[$i]))
                                        <img src="{{ asset('storage/' . $photoUrls[$i]) }}" alt="Photo {{ $i }}" style="max-width: 100%;">
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>

                <!-- Term for display to public this location/event -->
                <div class="mb-4 p-4 border rounded bg-light">
                    <h4 class="form-label d-inline">Display Period</h4>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="display_start" class="d-inline me-3">Start date</label>
                            <input type="date" id="display_start" name="display_start" class="form-control" value="{{ old('display_start', $business->display_start) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="display_end" class="d-inline me-3">End date</label>
                            <input type="date" id="display_end" name="display_end" class="form-control" value="{{ old('display_end', $business->display_end) }}">
                        </div>
                    </div>

                    <div class="text-danger" style="color:#D24848; line-height: 1.2;">
                        <p class="mb-1">* No setting start date will be "no publish to user."</p>
                        <p class="mb-1">* No setting start and end date will be "no publish to user."</p>
                        <p class="mb-0">* Setting start and no end date will be "no limit date to publish to user."</p>
                    </div>
                    
                </div>
                
                <!-- Submission Buttons -->
                <div class="row mt-3 justify-content-center">
                    <div class="col-4">
                        <button type="submit" class="btn btn-green w-100 mb-2" id="save-button">
                            SAVE
                        </button>
                        <input type="checkbox" class="form-check-input mb-2" id="official-check">
                        Apply for Official certification badge
                    </div>

                    <!-- checkboxにチェックをつけた場合 -->
                    @include('businessusers.businesses.modals.save_official')

                    <!-- checkboxにチェックをつけない場合 -->
                    @include('businessusers.businesses.modals.save')

                    <div class="col-2"></div>
                    <div class="col-4 ">
                        <a href="{{route('profile')}}">
                            <button class="btn btn-red w-100 ">CANCEL</button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
</main>
    @endsection