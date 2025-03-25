@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/business.css">
    <link rel="stylesheet" href="{{ asset('css/homebody.css')}}">
@endsection

@section('title', 'Hop Hotel - Business View')

@section('content')
    <div class="bg-blue pt-3 m-0 mb-0">
        <div class="container col-9 pt-5">
            <!-- Main Image Section -->
            <section class="main-image-section mb-5">
                <img class="main-image" alt="Main picture" src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg') }}" />
                <img src="{{ asset('images/logo/Official_Badge.png') }}" alt="Official badge"  class="avatar-lg d-none d-md-block">
                <img src="{{ asset('images/logo/Official_Badge.png') }}" alt="Official badge"  class="badge-md d-md-none">

                <div class="header-info text-white w-100 poppins-semibold">
                    <h2>Hop Hotel</h2>

                    <div class="fs-4">
                        2025/01/01 - 2025/01/3(Event only)
                    </div>

                    <div class=>
                        We are now offering a ¥1,000 discount for student guests staying for entrance exams!
                    </div>
                </div>
            </section>

            <!-- User Profile Header -->
            <div class="pb-4">
                @include('quests.user-bar')
            </div>

            <section class="promotion my-5">
                <h3 class="poppins-semibold text-center">Promotions</h3>
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-4 mb-2 mb-md-0"> <!-- ✅ マージン調整 -->
                            <div class="bg-white rounded-4 p-3 text-center">
                                <h6 class="raleway-semibold">🌟 Experience the Magic of Summer at HopHotel! 🌟</h6>
                                <img src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="Promotion Photo" class="img-fluid">
                            
                                <p class="mb-0 raleway-semibold">2024/12/24-2025/01/20</p>
                                <p class="mb-0 text-start pro-intro">Join us for an unforgettable Summer Festival at HopHotel! Join us for an unforgettable Summer Festival at HopHotel! ...</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2 mb-md-0"> <!-- ✅ マージン調整 -->
                            <div class="bg-white rounded-4 p-3 text-center">
                                <h6 class="raleway-semibold">🌟 Experience the Magic of Summer at HopHotel! 🌟</h6>
                                <img src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="Promotion Photo" class="img-fluid">
                            
                                <p class="mb-0 raleway-semibold">2024/12/24-2025/01/20</p>
                                <p class="mb-0 text-start pro-intro">Join us for an unforgettable Summer Festival at HopHotel! Join us for an unforgettable Summer Festival at HopHotel! ...</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2 mb-md-0"> <!-- ✅ マージン調整 -->
                            <div class="bg-white rounded-4 p-3 text-center">
                                <h6 class="raleway-semibold">🌟 Experience the Magic of Summer at HopHotel! 🌟</h6>
                                <img src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="Promotion Photo" class="img-fluid">
                            
                                <p class="mb-0 raleway-semibold">2024/12/24-2025/01/20</p>
                                <p class="mb-0 text-start pro-intro">Join us for an unforgettable Summer Festival at HopHotel! Join us for an unforgettable Summer Festival at HopHotel! ...</p>
                            </div>
                        </div>
                    </div>
                    <div class="row px-0 ms-0 w-100">
                        <a href="#"></a>
                    </div>
                </div>
                <script>
                    document.querySelectorAll('.pro-intro').forEach(elem => {
                        const text = elem.textContent;
                        if (text.length > 70) {
                            elem.textContent = text.substring(0, 60) + "...";
                        }
                    });
                </script>
                                
            </section>

            <!-- Hotel Description -->
            <div class="bg-white rounded-4 mb-4 p-3 py-5">
                    <p class="mb-0">
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

            <!-- Location Map -->
            <div class="container pt-4">
                <div class="row my-0 justify-content-center"> <!-- ✅ md 以下で中央寄せ -->
                    <!-- ✅ 左側の情報エリア (col-lg-9) -->
                    <div class="col-lg-6 pe-3 d-flex flex-column justify-content-between text-lg-start text-center align-items-lg-start align-items-center">
                        <div class="location-details col-md w-100 px-0">
                            @foreach([
                                'Service Category :' => 'Location',
                                'Status :' => 'Active',
                                'Identification No. :' => '12345678123',
                                'Phone Number :' => '03-1234-5678',
                            ] as $label => $value)
                                <div class="row d-flex bg-white rounded-3 mb-2 p-2 flex-grow-1">
                                    <div class="col-7 poppins-semibold text-lg-end text-center">
                                        {{ $label }}
                                    </div>
                                    <div class="col-5">
                                        {{ $value }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
            
                        <div class="location-details col-md w-100 px-0">
                            @foreach([
                                'Address - in local language :' => '〒131-0045 東京都墨田区押上１丁目１−２',
                                'Address - in English :' => '1-1-2 Oshiage, Sumida City, Tokyo 131-0045, Japan'
                            ] as $label => $value)
                                <div class="row d-flex bg-white rounded-4 mb-2 p-2 flex-grow-1 text-center align-items-center">
                                    <div class="col-12 poppins-semibold d-flex justify-content-center">
                                        {{ $label }}
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        {{ $value }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
            
                    <!-- ✅ 右側のマップエリア (col-lg-3) -->
                    <div class="col-lg-6 px-1 py-3 mb-2 bg-white rounded-3">
                        <div class="w-100">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.146784010381!2d123.903637375094!3d10.33013598979281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9992189a343c3%3A0xa7758b38dbbe1750!2sQQEnglish%20IT%20Park%20Campus!5e0!3m2!1sja!2sph!4v1742469854398!5m2!1sja!2sph" 
                                width="100%" height="300" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade" 
                                class="d-block mx-auto">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- <!-- Website and Social Media --> --}}
            <div class="p-3 text-center pb-0">
                <p class="poppins-regular mb-0">
                    Official Web site : https://asdjfnpeiupfnaeijfaeirngp.com
                </p>
            </div>
                    {{-- SNS icons --}}
            <div class="row justify-content-center mb-4">
                <div class="col-auto d-flex py-2">
                    <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-instagram text-dark icon-md mx-2"></i>
                    </a>
                
                    <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-facebook text-dark icon-md mx-2"></i>
                
                    <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-x-twitter text-dark icon-md px-0 mx-2"></i>
                    </a>
                
                    <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-tiktok text-dark icon-md px-0 mx-2"></i>
                    </a>
                </div>
            </div>
                    {{-- @foreach(['instagram', 'facebook', 'twitter', 'tiktok'] as $social)
                        <img
                            class="social-icon"
                            alt="{{ ucfirst($social) }}"
                            src="{{ asset('public/ic-outline-' . $social . '.svg') }}"
                        />
                    @endforeach --}}

            <!-- Business Hours -->
            <section class="px-0 my-5">
                <h3 class="text-center poppins-semibold">Business Hours</h3>

                <div class="bg-white rounded-5 p-3">
                            <table class="hours-table">
                                <thead>
                                    <tr>
                                        <th class="text-end">Day</th>
                                        <th class="text-center">Hours</th>
                                        <th class="text-center d-none d-sm-table-cell">Break</th>
                                        <th class="text-center d-none d-sm-table-cell">Notice</th> 
                                        <!-- ✅ sm以上で表示 -->
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
                                    ] as $index => [$day, $hours, $break, $notice])
                                        <tr>
                                            <tr>
                                                <td class="text-end raleway-semibold pe-3 w-auto">{{ $day }} :</td> <!-- ✅ sm以下で均等に -->
                                                <td class="text-center w-auto">{{ $hours }}</td> <!-- ✅ sm以下で均等に -->
                                            
                                            <!-- ✅ sm以上では break をそのまま表示 -->
                                            <td class="text-center d-none d-sm-table-cell">
                                                {{ $break !== 'ー' ? $break : 'ー' }}
                                            </td>
                                            
                                            <!-- ✅ md以上では notice をそのまま表示 -->
                                            <td class="text-center d-none d-md-table-cell">
                                                {{ $notice !== 'ー' ? $notice : 'ー' }}
                                            </td>
                            
                                            <!-- ✅ md以下では notice がある場合のみボタンを表示、ない場合は "ー" -->
                                            <td class="text-center d-none d-sm-table-cell d-md-none">
                                                @if ($notice !== 'ー')
                                                    <button class="btn btn-sm btn-red" type="button" data-bs-toggle="collapse" data-bs-target="#notice-{{ $index }}">
                                                        Notice
                                                    </button>
                                                @else
                                                    ー
                                                @endif
                                            </td>
                                        </tr>
                            
                                        <!-- ✅ md以下で notice がある場合のみトグル表示 -->
                                        @if ($notice !== 'ー')
                                            <tr id="notice-{{ $index }}" class="collapse d-md-none">
                                                <td colspan="4" class="text-center bg-light">
                                                    {{ $notice }}
                                                </td>
                                            </tr>
                                        @endif

                                        <!-- ✅ `break` のトグル対象 -->
                                        @if ($break !== 'ー')
                                        <tr id="break-{{ $index }}" class="collapse">
                                            <td colspan="4" class="text-center bg-light">
                                                {{ $break }}
                                            </td>
                                        </tr>
                                        @endif
                                        
                                        <tr class="d-sm-table-row d-sm-none">
                                            <td colspan="2" class="text-center p-0 notice">
                                                @if ($break !== 'ー')
                                                    <button class="btn btn-sm btn-navy p-0 my-1 notice" type="button" data-bs-toggle="collapse" data-bs-target="#break-{{ $index }}">
                                                        Break
                                                    </button>
                                                @endif
                                                @if ($notice !== 'ー')
                                                    <button class="btn btn-sm btn-red ms-2 p-0 my-1 notice" type="button" data-bs-toggle="collapse" data-bs-target="#notice-{{ $index }}">
                                                        Notice
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                </div>
            </section>

            <!-- Delails -->
            <section class="my-5 px-0">
                <h3 class="poppins-semibold text-center">Details</h3>

                <div class="bg-white rounded-5 p-5">
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
                    <div class="row justify-content-center"> <!-- ✅ ここで中央寄せ --> 
                            @foreach($amenityGroups as $groupName => $items)
                                <div class="row">
                                    <div class="col-md-3 poppins-semibold mb-3 text-center text-md-end">
                                        {{ $groupName }} :
                                    </div>

                                    <div class="col-9">
                                        <div class="row">
                                            @foreach($items as $index => [$id, $label, $checked])
                                                <div class="col-lg-6">
                                                    <div class="d-flex align-items-center">
                                                        @if (!$checked)
                                                            <i class="fa-solid fa-circle-xmark color-red pe-2 mb-3 fs-4"></i>
                                                        @else
                                                            <i class="fa-solid fa-circle-check color-green pe-2 mb-3 fs-4"></i>
                                                        @endif
                                                        <label for="{{ $id }}" class="mb-3">
                                                            {{ $label }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                @if(!$loop->last)
                                    <hr class="w-75 mx-auto">
                                @endif
                            @endforeach
                    </div>
                </div>
            </section>

            <!-- Quest Section -->
            <section class="quest-section my-4 mx-0">
                <h3 class="poppins-semibold text-center mb-3">
                    Quest
                </h3>

                <div class="quest-container">
                    <div class="row d-flex p-0 m-0">
                    @for($i = 1; $i <= 3; $i++)
                            <div class="col-md-4 bg-none p-3">
                                <div class=" bg-white rounded-4 p-3">
                                <img class="img-fluid" alt="Mount Fuji" src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg') }}">
                                <div class="card-header bg-white p-0">
                                        <p class="raleway-semibold m-0 fs-7">
                                            Mount Fuji
                                        </p>
                                        <p class="text-end fs-8 m-0">
                                            1 day
                                        </p>
                                    </div>

                            {{-- Heart icon & Like function --}}
                                <div class="container-fluid fs-7">
                                    <div class="d-flex align-items-center ps-0 justify-content-center">
                                        <form action="#" method="post">
                                            @csrf

                                            <button type="submit" class="btn btn-sm shadow-none ps-0">
                                                <i class="fa-regular fa-heart"></i>
                                            </button>
                                        </form>

                                        <button class="btn btn-sm p-0 text-center">
                                            <span>10</span>
                                        </button>
                                    {{-- Modal for displaying all users who liked owner of post--}}
                                                                    
                                    {{-- Comment icon & Number of comments --}}
                                    <div class="col-auto d-flex ms-3">
                                        <div>
                                            <i class="fa-regular fa-comment"></i>
                                        </div>

                                        <button class="btn btn-sm p-0 text-center">
                                            <span>&nbsp;&nbsp;52</span>
                                        </button>
                                    </div>

                                    {{--  --}}
                                    <div class="col-auto d-flex ms-3">
                                        <div>
                                            <i class="fa-solid fa-chart-simple"></i>
                                        </div>

                                        <button class="btn btn-sm p-0 text-center">
                                            <span>&nbsp;&nbsp;201</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </section>

            <!-- Hotel Images -->
            <div class="my-5">
                <h3 class="poppins-semibold text-center">Photos</h3>
                <div class="row w-100 mx-0 px-0">
                    <div class="col-md mb-2 mb-md-0">
                        <img class="img-fluid" alt="Hotel Room" src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg') }}" />
                    </div>
                    <div class="col-md mb-2 mb-md-0">
                        <img class="img-fluid" alt="Hotel Room" src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg') }}" />
                    </div>
                    <div class="col-md mb-2 mb-md-0">
                        <img class="img-fluid" alt="Hotel Room" src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg') }}" />
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <hr>
            <div class="text-center pb-5">
            @include('comment.body')
            </div>

            <!-- Go to Top Button -->
            <div class="top-button-container">
                <button class="top-button">
                    <a href="#" class="text-decoration-none color-navy">
                        <i class="fa-solid fa-plane-up fs-3"></i>
                        <p class="color-navy m-0 p-0 text-center fs-8 poppins-semibold">Go TOP</p>
                    </a>
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
