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
