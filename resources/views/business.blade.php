@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/view-business.css') }}">

@section('title', 'Business View')

@section('content')
    <div class="page-wrapper">
        <div class="page-container">

            <!-- Main Image Section -->
            <section class="main-image-section">
                <div class="main-image-wrapper">
                    <img class="main-image" alt="Main picture" src="{{ $business->main_image }}" />

                    <div class="main-title">
                        {{ $business->name }}
                    </div>
                    <div class="event-dates">
                        {{ $business->term_start }} - {{ $business->term_end }}
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

            <!-- Business Introduction -->
            <section class="business-introduction">
                <h3>Business Introduction</h3>
                <div class="introduction-box">                   
                    <p>{{ $business->introduction }}</p>
                </div>
            </section>

            <!-- Business Location -->
            <section class="business-location">
                <h3>Business Location</h3>
                <div class="location-wrapper">
                    <div class="location-details">
                        <div class="info-row">
                            <div class="info-label">
                                Service Category :
                            </div>
                            <div class="info-value">
                                {{ $business->service_category }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Status :
                            </div>
                            <div class="info-value">
                                {{ $business->status }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Identification No. :
                            </div>
                            <div class="info-value">
                                {{ $business->identification_number }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Phone Number :
                            </div>
                            <div class="info-value">
                                {{ $business->phonenumber }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Address - in local language :
                            </div>
                            <div class="info-value">
                                {{ $business->address_1 }}
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-label">
                                Address - in English :
                            </div>
                            <div class="info-value">
                                {{ $business->address_2 }}
                            </div>
                        </div>
                    </div>
                    <div class="location-map">
                        <img alt="Google map view" src="{{ asset('public/google-map-view.svg') }}" />
                    </div>
                </div>
            </section>

            <!-- Website and Social Media -->
            <div class="web-social">
                <div class="web-social-content">
                    <h5 class="official-site">
                        Official Web site : {{ $business->website_url }}
                    </h5>
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
            </div>

            <!-- Business Hours -->
            <section class="business-hours">
                <h3>Business Hours</h3>
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
                            @foreach($businessHours as $hour)
                                <tr>
                                    <td>{{ $hour['day_of_week'] }} :</td>
                                    <td>{{ $hour['opening_time'] }} - {{ $hour['closing_time'] }}</td>
                                    <td>{{ isset($hour['break_start']) ? $hour['break_start'] . ' - ' . $hour['break_end'] : 'ー' }}</td>
                                    <td>{{ $hour['notice'] ?? 'ー' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Amenities -->
            <section class="amenities-section">
                <h2 class="amenities-title">
                    Amenities
                </h2>

                <div class="amenities-container">
                    @php
                        $amenityGroups = [
                            'Accessibility' => [
                                ['wheelchair', 'Wheel chair accessible', true],
                                ['accessibleParking', 'Accessible parking', false],
                                ['brailleSignage', 'Braille signage', false],
                                ['elevatorAccess', 'Elevator access', true],
                                ['accessibleRestroom', 'Accessible restroom', false],
                                ['hearingLoop', 'Hearing loop system', false]
                            ],
                            'Facility' => [
                                ['freeWifi', 'Free Wi-Fi', true],
                                ['parkingAvailable', 'Parking available', true],
                                ['changingRoom', 'Changing room', true],
                                ['publicRestrooms', 'Public restrooms', true],
                                ['bicycleParking', 'Bicycle parking', false],
                                ['showerFacilities', 'shower facilities', false]
                            ],
                            'Payment Options' => [
                                ['creditCards', 'Credit cards accepted', true],
                                ['cashOnly', 'Cash Only', false],
                                ['internationalCards', 'International payment cards', false],
                                ['digitalPayment', 'Digital payment', true],
                                ['contactlessPayments', 'Contactless Payments', false]
                            ],
                            'Smoking Policy' => [
                                ['nonSmoking', 'Completely non-smoking', true],
                                ['designatedRooms', 'Designated smoking rooms', false],
                                ['smokingPermitted', 'Smoking permitted throughout', false],
                                ['smokingArea', 'Smoking area available', true],
                                ['outdoorSmoking', 'Outdoor smoking section', false]
                            ]
                        ];
                    @endphp

                    @foreach($amenityGroups as $groupName => $items)
                        <div class="amenity-group">
                            <div class="amenity-group-title">
                                {{ $groupName }} :
                            </div>
                            <div class="amenity-items-container">
                                <div class="amenity-grid">
                                    @foreach($items as [$id, $label, $checked])
                                        <div class="amenity-item">
                                            <input 
                                                type="checkbox" 
                                                id="{{ $id }}" 
                                                {{ $checked ? 'checked' : '' }}
                                                disabled
                                                class="amenity-checkbox"
                                            />
                                            <label for="{{ $id }}" class="amenity-label">
                                                {{ $label }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr class="amenity-divider" />
                        @endif
                    @endforeach
                </div>
            </section>

            <!-- Quest Section -->
            <section class="quest-section">
                <h2 class="quest-title">
                    Quest
                </h2>

                <div class="quest-grid">
                    @for($i = 1; $i <= 4; $i++)
                        <div class="quest-card">
                            <div class="quest-card-content">
                                <img
                                    class="quest-image"
                                    alt="Mount Fuji"
                                    src="{{ asset('public/image-3.png') }}"
                                />

                                <div class="quest-card-info">
                                    <div class="quest-card-header">
                                        <p class="quest-name">
                                            Mount Fuji
                                        </p>
                                        <span class="quest-date">
                                            2025/2/20
                                        </span>
                                    </div>

                                    <div class="quest-stats">
                                        @foreach(['heart', 'message-circle', 'share-2'] as $icon)
                                            <div class="stat-item">
                                                <img src="{{ asset('public/' . $icon . '.svg') }}" class="stat-icon" alt="{{ $icon }}" />
                                                <span class="stat-value">1033</span>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="quest-footer">
                                        <div class="quest-user">
                                            <div class="user-avatar">
                                                <img src="{{ asset('public/main-picture-1.png') }}" alt="Profile" class="avatar-image" />
                                            </div>
                                            <span class="user-name">
                                                Mt. Fuji Official
                                            </span>
                                        </div>

                                        <button class="follow-button">
                                            <span class="follow-text">
                                                FOLLOW
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
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

@endsection
