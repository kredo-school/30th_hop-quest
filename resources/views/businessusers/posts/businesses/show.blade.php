@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/business.css') }}">

@section('title', 'Hop Hotel - Business View')

@section('content')
    <div class="page-wrapper">
        <div class="page-container">

            <!-- Main Image Section -->
            <section class="main-image-section">
                <div class="main-image-wrapper">
                    <img class="main-image" alt="Main picture" src="{{ asset('public/main-picture-3.png') }}" />

                    <div class="main-title">Hop Hotel</div>

                    <div class="main-subtitle">
                        We are now offering a ¥1,000 discount for student guests staying for entrance exams!
                    </div>

                    <div class="event-dates">
                        2025/01/01 - 2025/01/3(Event only)
                    </div>

                    <img class="official-badge" alt="Official badge" src="{{ asset('public/official-badge.png') }}" />
                </div>
            </section>

            <!-- User Profile Header -->
            <section class="profile-header">
                <div class="profile-container">
                    <div class="profile-left">
                        <div class="profile-main">
                            <div class="profile-pic">
                                <img src="{{ asset('public/image-4.png') }}" alt="User profile" />
                            </div>

                            <div class="profile-name">Business_0719</div>

                            <button class="follow-btn">
                                <span>Follow</span>
                            </button>
                        </div>

                        <div class="profile-icons">
                            @foreach(['heart', 'message-square', 'eye'] as $icon)
                                <div class="icon-wrapper">
                                    <img src="{{ asset('public/' . $icon . '.svg') }}" alt="{{ $icon }}" />
                                    <span>0</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="profile-update">
                        UPDATE : 2025/01/01
                    </div>
                </div>
            </section>

<<<<<<< HEAD:resources/views/business.blade.php
            <!-- Hotel Description -->
            <div class="hotel-description">
                <div class="description-box">
                    <p>
                        Welcome to Hop Hotel!
                        <br />
                        Nestled in the heart of Tokyo, Hop Hotel offers a perfect blend of comfort, convenience, and modern elegance. Whether you're visiting for business or leisure, our stylish rooms, exceptional service, and top-notch amenities ensure a relaxing and enjoyable stay.
                        <br />✨ Why Choose Hop Hotel?
                        <br />
                        Prime location near major attractions and transport hubs
                        <br />
                        Cozy and well-equipped rooms with free Wi-Fi
                        <br />
                        Delicious dining options and refreshing beverages
                        <br />
                        Friendly staff dedicated to making your stay memorable
                        <br />
                        Come and experience true hospitality at Hop Hotel! We look forward to welcoming you. 😊🏨✨
                    </p>
=======
            <!-- Business Promotion -->
            <section class="business-promotion">
                <h3>Business Promotion</h3>
                <div class="promotion-container">
                    @if(count($businessPromotions) > 0)
                        <div class="promotion-carousel">
                            <div class="carousel-controls">
                                <button class="carousel-arrow prev" role="button" aria-label="Previous slide">&larr;</button>
                                <button class="carousel-arrow next" role="button" aria-label="Next slide">&rarr;</button>
                            </div>
                            
                            <div class="carousel-items-container">
                                @foreach($businessPromotions as $index => $promotion)
                                    <div class="promotion-item {{ $index < 5 ? 'active' : '' }}">
                                        @include('businessusers.posts.promotions._promotion', ['promotion' => $promotion])
                                    </div>
                                @endforeach
                            </div>
                            
                            <div class="carousel-indicators">
                                @php
                                    $totalSlides = ceil(count($businessPromotions) / 3);
                                @endphp
                                @for($i = 0; $i < $totalSlides; $i++)
                                    <div class="carousel-indicator {{ $i === 0 ? 'active' : '' }}" data-index="{{ $i }}"></div>
                                @endfor
                            </div>
                        </div>
                    @else
                        <div class="text-center">No promotions available</div>
                    @endif
                </div>
            </section>

            <!-- Business Introduction -->
            <section class="business-introduction">
                <h3>Business Introduction</h3>
                <div class="introduction-box">                   
                    <p>{{ $business->introduction }}</p>
>>>>>>> f24e510 (Modify ViewBusiness):resources/views/businessusers/posts/businesses/show.blade.php
                </div>
            </div>

            <!-- Location Map -->
            <section class="location-section">
                <div class="location-wrapper">
                    <div class="location-details">
                        @foreach([
                            'Service Category :' => 'Location',
                            'Status :' => 'Active',
                            'Identification No. :' => '12345678123',
                            'Phone Number :' => '03-1234-5678',
                            'Address - in local language :' => '〒131-0045 東京都墨田区押上１丁目１−２',
                            'Address - in English :' => '1-1-2 Oshiage, Sumida City, Tokyo 131-0045, Japan'
                        ] as $label => $value)
                            <div class="info-row">
                                <div class="info-label">
                                    {{ $label }}
                                </div>
                                <div class="info-value">
                                    {{ $value }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="location-map">
                        <img alt="Google map view" src="{{ asset('public/google-map-view.svg') }}" />
                    </div>
                </div>
            </section>

            <!-- Website and Social Media -->
            <div class="web-social">
                <p class="official-site">
                    Official Web site : https://asdjfnpeiupfnaeijfaeirngp.com
                </p>
                <div class="social-icons">
                    @foreach(['instagram', 'facebook', 'twitter', 'tiktok'] as $social)
                        <img
                            class="social-icon"
                            alt="{{ ucfirst($social) }}"
                            src="{{ asset('public/ic-outline-' . $social . '.svg') }}"
                        />
                    @endforeach
                </div>
            </div>

            <!-- Business Hours -->
            <section class="business-hours">
                <h2>Business Hours</h2>

                <div class="hours-table-wrapper">
                    <table class="hours-table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Operating Hours</th>
                                <th>Break time</th>
                                <th>Notice</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach([
                                ['Monday', '0:00-23:59', 'ー', 'ー'],
                                ['Tuesday', '0:00-23:59', 'ー', 'Last order 40 minutes before closing'],
                                ['Wednesday', '0:00-23:59', 'ー', 'ー'],
                                ['Thursday', '0:00-23:59', 'ー', 'ー'],
                                ['Friday', '0:00-23:59', 'ー', 'ー'],
                                ['Saturday', '0:00-23:59', '12:00-13:00', 'ー'],
                                ['Sunday', '0:00-23:59', '12:00-13:00', 'ー']
                            ] as [$day, $hours, $break, $notice])
                                <tr>
                                    <td>{{ $day }} :</td>
                                    <td>{{ $hours }}</td>
                                    <td>{{ $break }}</td>
                                    <td>{{ $notice }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Details -->
            <section class="details-section">
                <h2 class="details-title">
                    Details
                </h2>

                <div class="details-container">
                    @foreach($businessInfoCategories as $index => $category)
                        <div class="amenity-group">
                            <div class="amenity-group-title">
                                {{ $category->name }} :
                            </div>
                            <div class="amenity-items-container">
                                <div class="amenity-grid">
                                    @foreach($category->businessInfos as $info)
                                        @php
                                            $isValid = false;
                                            if ($info->businessDetails->isNotEmpty()) {
                                                $isValid = $info->businessDetails->first()->is_valid;
                                            }
                                        @endphp
                                        <div class="amenity-item">
                                            <label for="{{ $info->id }}" class="amenity-label">
                                                {{ $info->name }}
                                            </label>
                                            <input 
                                                type="checkbox" 
                                                id="{{ $info->id }}" 
                                                {{ $isValid ? 'checked' : '' }}
                                                disabled
                                                class="amenity-checkbox"
                                            />
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if($index < count($businessInfoCategories) - 1)
                            <hr class="amenity-divider" />
                        @endif
                    @endforeach
                </div>
            </section>

            <!-- Quest Section -->
            <section class="quest-section">
                <h2 class="quest-title">
                    Model Quest
                </h2>

     
            </section>

            <!-- Hotel Images -->
            <div class="hotel-images">
                <img class="hotel-image" alt="Hotel Room" src="{{ asset('public/rectangle-287.png') }}" />
                <img class="hotel-image" alt="Hotel Facilities" src="{{ asset('public/rectangle-288.png') }}" />
            </div>

            <!-- Comments Section -->
            <hr>
            @include('comment.body')

            <!-- Go to Top Button -->
            <div class="top-button-container">
                <button
                    onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                    class="top-button"
                >
                    <img src="{{ asset('public/arrow-up.svg') }}" alt="Arrow Up" class="top-button-icon" />
                    <span class="top-button-text">Go TOP</span>
                </button>
            </div>
        </div>
    </div>


    {{-- public/map.js --}}
    <script src="{{ asset('map.js') }}"></script>

    {{-- Google Maps API (callback=initMap) --}}
    <script async
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initMap">
    </script>

    {{--promotion carousel --}}
    <script src="{{ asset('js/viewbusiness.js') }}"></script>

@endsection
