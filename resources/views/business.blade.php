@extends('layouts.app')

<style>
        @import url("https://fonts.googleapis.com/css?family=Inter:400|Poppins:500,400|Raleway:700,600,400");
</style>
<script src="https://cdn.tailwindcss.com"></script>

@section('title', 'Hop Hotel - Business View')

@section('content')
<div class="bg-[#4496e366] flex flex-row justify-center w-full">
    <div class="bg-[#4496e366] w-full max-w-[1024px] relative">
        <!-- Navigation Bar -->
        <header class="w-full h-[100px] bg-white shadow-md flex items-center justify-between px-4">
            <img class="w-[106px] h-[81px] object-cover" alt="Element" src="{{ asset('public/--------------1--2.png') }}" />
            
            <div class="relative w-[275px] h-10 ml-8">
                <input 
                    type="text"
                    class="h-10 px-8 py-3 bg-white rounded-[5px] border border-solid border-[#73b0e8]"
                    placeholder="Search Bar"
                />
            </div>

            <nav class="ml-auto">
                <ul class="flex gap-6">
                    @foreach(['Home', '+Add', 'For Business', 'FAQ'] as $link)
                        <li>
                            <a href="#" class="font-['Inter',Helvetica] font-normal text-[#3d7bb2] text-xl">
                                {{ $link }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>

            <img class="w-[71px] h-[68px] ml-6 object-cover" alt="User profile" src="{{ asset('public/image-5.png') }}" />
        </header>

        <!-- Main Image Section -->
        <section class="w-full my-8 relative">
            <div class="relative w-full h-[520px]">
                <img class="w-full h-[456px] object-cover mt-[60px]" alt="Main picture" src="{{ asset('public/main-picture-3.png') }}" />

                <div class="absolute w-full bottom-[45px] left-[92px] [text-shadow:0px_4px_4px_#00000040] [-webkit-text-stroke:1px_#000000] [font-family:'Poppins',Helvetica] font-medium text-[#fff8f8] text-[40px]">
                    Hop Hotel
                </div>

                <div class="absolute w-full bottom-[10px] left-[92px] [text-shadow:0px_4px_4px_#00000040] [-webkit-text-stroke:1px_#000000] [font-family:'Poppins',Helvetica] font-normal text-white text-lg">
                    We are now offering a ¥1,000 discount for student guests staying for entrance exams!
                </div>

                <div class="absolute bottom-[80px] left-16 w-full [text-shadow:0px_4px_4px_#00000040] [-webkit-text-stroke:1px_#000000] [font-family:'Poppins',Helvetica] font-medium text-white text-[25px] text-center">
                    2025/01/01 - 2025/01/3(Event only)
                </div>

                <img class="absolute w-[169px] h-[169px] top-0 left-0 object-cover" alt="Official badge" src="{{ asset('public/official-badge.png') }}" />
            </div>
        </section>

        <!-- User Profile Header -->
        <section class="w-full rounded-[15px] bg-white p-3.5">
            <div class="flex justify-between">
                <div class="flex flex-col">
                    <div class="flex items-center">
                        <div class="w-[58px] h-[58px] rounded-full overflow-hidden">
                            <img src="{{ asset('public/image-4.png') }}" alt="User profile" class="w-full h-full object-cover" />
                        </div>

                        <div class="ml-[14px]">
                            <div class="font-normal text-xl leading-[26.6px] font-['Poppins',Helvetica]">
                                Business_0719
                            </div>
                        </div>

                        <button class="ml-[31px] h-[26px] w-[91px] rounded-[20px] bg-[#4496e3] hover:bg-[#3a85cc] text-white">
                            <span class="text-sm font-normal leading-[18.6px] font-['Poppins',Helvetica]">
                                Follow
                            </span>
                        </button>
                    </div>

                    <div class="flex mt-3 ml-[62px]">
                        @foreach(['heart', 'message-square', 'eye'] as $icon)
                            <div class="flex items-center mr-4">
                                <img src="{{ asset('public/' . $icon . '.svg') }}" class="w-6 h-6" alt="{{ $icon }}" />
                                <span class="ml-2 text-sm leading-[18.6px] font-normal text-black font-['Poppins',Helvetica]">
                                    0
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="text-[#00000080] text-xl font-normal leading-[26.6px] font-['Poppins',Helvetica]">
                    UPDATE : 2025/01/01
                </div>
            </div>
        </section>

        <!-- Hotel Description -->
        <div class="w-full px-4 md:px-6 lg:px-[99px] mt-8">
            <div class="w-full bg-[url({{ asset('public/flame.svg') }})] bg-[100%_100%] p-6">
                <p class="font-['Poppins',Helvetica] text-lg text-black leading-[30px]">
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
        <section class="w-full max-w-[822px] my-8">
            <div class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    @foreach([
                        'Service Category :' => 'Location',
                        'Status :' => 'Active',
                        'Identification No. :' => '12345678123',
                        'Phone Number :' => '03-1234-5678'
                    ] as $label => $value)
                        <div class="bg-transparent border rounded-md overflow-hidden mb-2">
                            <div class="p-2 flex items-center">
                                <div class="w-[165px] font-normal text-black text-base text-right mr-4">
                                    {{ $label }}
                                </div>
                                <div class="font-normal text-black text-[15px]">
                                    {{ $value }}
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Address sections -->
                    <div class="mt-4 space-y-4">
                        <div class="bg-transparent border rounded-md overflow-hidden">
                            <div class="p-4">
                                <h3 class="text-center font-normal text-black text-base mb-2">
                                    Address - in local language:
                                </h3>
                                <p class="text-center font-normal text-black text-sm">
                                    〒131-0045 東京都墨田区押上１丁目１−２
                                </p>
                            </div>
                        </div>

                        <div class="bg-transparent border rounded-md overflow-hidden">
                            <div class="p-4">
                                <h3 class="text-center font-normal text-black text-base mb-2">
                                    Address - in English:
                                </h3>
                                <p class="font-normal text-black text-base">
                                    1-1-2 Oshiage, Sumida City, Tokyo 131-0045, Japan
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    <div class="h-full bg-transparent border rounded-md overflow-hidden">
                        <img class="w-full h-full object-cover" alt="Google map view" src="{{ asset('public/google-map-view.svg') }}" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Website and Social Media -->
        <div class="w-full flex flex-col items-center justify-center mt-8 px-4">
            <p class="font-['Poppins',Helvetica] text-lg text-black text-center leading-[30px]">
                Official Web site : https://asdjfnpeiupfnaeijfaeirngp.com
            </p>
            <div class="flex items-center justify-center gap-8 mt-4">
                @foreach(['instagram', 'facebook', 'twitter', 'tiktok'] as $social)
                    <img
                        class="w-[59px] h-[59px]"
                        alt="{{ ucfirst($social) }}"
                        src="{{ asset('public/ic-outline-' . $social . '.svg') }}"
                    />
                @endforeach
            </div>
        </div>

        <!-- Business Hours -->
        <section class="w-full max-w-[815px] mx-auto my-12">
            <h2 class="text-[35px] font-medium text-center mb-8 font-['Poppins',Helvetica]">
                Business Hours
            </h2>

            <div class="w-full bg-[url({{ asset('public/business-hours.png') }})] bg-[100%_100%] p-8">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="w-[125px]"></th>
                            <th class="text-center text-xs text-[#00000080] font-normal font-['Poppins',Helvetica]">Operating Hours</th>
                            <th class="text-center text-xs text-[#00000080] font-normal font-['Poppins',Helvetica]">Break time</th>
                            <th class="text-center text-xs text-[#00000080] font-normal font-['Poppins',Helvetica]">Notice</th>
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
                                <td class="text-right font-['Poppins',Helvetica] font-normal text-base">
                                    {{ $day }} :
                                </td>
                                <td class="text-center font-['Raleway',Helvetica] font-normal text-base">
                                    {{ $hours }}
                                </td>
                                <td class="text-center font-['Raleway',Helvetica] font-normal text-base">
                                    {{ $break }}
                                </td>
                                <td class="text-center font-['Raleway',Helvetica] font-normal text-base">
                                    {{ $notice }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Amenities -->
        <section class="w-full max-w-[815px] mx-auto my-16">
            <h2 class="text-[35px] text-center font-medium text-black mb-8 font-['Poppins',Helvetica]">
                Amenities
            </h2>

            <div class="w-full bg-[url({{ asset('public/flame.svg') }})] bg-[100%_100%] p-12">
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
                    <div class="flex mb-8">
                        <div class="w-[170px] text-right pr-4 font-normal text-black text-base font-['Poppins',Helvetica]">
                            {{ $groupName }} :
                        </div>
                        <div class="flex-1">
                            <div class="grid grid-cols-2 gap-x-8 gap-y-1">
                                @foreach($items as [$id, $label, $checked])
                                    <div class="flex items-center space-x-2 mb-2">
                                        <input 
                                            type="checkbox" 
                                            id="{{ $id }}" 
                                            {{ $checked ? 'checked' : '' }}
                                            disabled
                                            class="rounded border-gray-300"
                                        />
                                        <label for="{{ $id }}" class="font-normal text-black text-base leading-[30px] font-['Raleway',Helvetica]">
                                            {{ $label }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @if(!$loop->last)
                        <hr class="my-4 w-[557px] mx-auto" />
                    @endif
                @endforeach
            </div>
        </section>

        <!-- Quest Section -->
        <section class="w-full max-w-[827px] mx-auto my-16">
            <h2 class="text-center text-[35px] font-medium font-['Poppins',Helvetica] text-black mb-16 [-webkit-text-stroke:1px_#000000]">
                Quest
            </h2>

            <div class="grid grid-cols-4 gap-[15px]">
                @for($i = 1; $i <= 4; $i++)
                    <div class="w-full rounded-[10px] bg-white overflow-hidden">
                        <div class="relative">
                            <img
                                class="w-full h-[120px] object-cover mx-auto mt-2 px-[13px]"
                                alt="Mount Fuji"
                                src="{{ asset('public/image-3.png') }}"
                            />

                            <div class="px-[13px] pt-3 pb-2">
                                <div class="flex justify-between items-start">
                                    <p class="font-['Raleway',Helvetica] text-[11px] text-black">
                                        Mount Fuji
                                    </p>
                                    <span class="font-['Inter',Helvetica] text-[10px] text-black">
                                        2025/2/20
                                    </span>
                                </div>

                                <div class="flex items-center mt-[6px] gap-2 text-[9px] font-['Inter',Helvetica] text-black">
                                    @foreach(['heart', 'message-circle', 'share-2'] as $icon)
                                        <div class="flex items-center">
                                            <img src="{{ asset('public/' . $icon . '.svg') }}" class="w-3 h-3" alt="{{ $icon }}" />
                                            <span class="ml-1">1033</span>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="flex items-center justify-between mt-[10px]">
                                    <div class="flex items-center">
                                        <div class="w-5 h-5 rounded-full overflow-hidden">
                                            <img src="{{ asset('public/main-picture-1.png') }}" alt="Profile" class="w-full h-full object-cover" />
                                        </div>
                                        <span class="ml-[7px] text-[10px] font-['Inter',Helvetica] text-black">
                                            Mt. Fuji Official
                                        </span>
                                    </div>

                                    <button class="h-[19px] w-[67px] rounded-sm bg-[url({{ asset('public/rectangle-108.svg') }})] bg-[100%_100%] p-0">
                                        <span class="text-[10px] font-['Poppins',Helvetica] text-white">
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
        <div class="w-full px-4 md:px-6 lg:px-[112px] mt-8 flex flex-col md:flex-row gap-4">
            <img class="w-full md:w-1/2 h-auto object-cover" alt="Hotel Room" src="{{ asset('public/rectangle-287.png') }}" />
            <img class="w-full md:w-1/2 h-auto object-cover" alt="Hotel Facilities" src="{{ asset('public/rectangle-288.png') }}" />
        </div>

        <!-- Comments Section -->
        <hr>
        @include('comment.body')

        <!-- Go to Top Button -->
        <div class="sticky bottom-8 ml-auto mr-8 mb-8 w-fit">
            <button
                onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
                class="w-[72px] h-[72px] bg-white rounded-full flex flex-col items-center justify-center text-black hover:bg-gray-100"
            >
                <img src="{{ asset('public/arrow-up.svg') }}" alt="Arrow Up" class="w-8 h-8" />
                <span class="text-[8px] mt-1">Go TOP</span>
            </button>
        </div>
    </div>
</div>
