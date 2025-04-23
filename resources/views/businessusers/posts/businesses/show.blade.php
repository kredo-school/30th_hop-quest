@extends('layouts.app')

@php
use Illuminate\Support\Str;
@endphp

<link rel="stylesheet" href="{{ asset('css/viewbusiness.css') }}">

@section('title', 'Business View')

@section('content')
    <div class="page-wrapper mt-5">
        <div class="page-container">

            <!-- Main Image Section -->
            <section class="main-image-section">
                <div class="main-image-wrapper mt-3">
                    <img class="main-image" alt="Main picture" src="{{ asset('storage'.$business->main_image) }}" />

                    <div class="main-title">
                        {{ $business->name }}
                    </div>
                    <div class="event-dates">
                        {{ $business->term_start }} - {{ $business->term_end }}
                    </div>

                    @if($business->official_certification==3)
                        <img src="{{ asset('images/logo/Official_Badge.png') }}" class="official-badge" alt="official">              
                    @else
                    @endif
                </div>
            </section>

            <!-- User Profile Header -->
            <section class="profile-header">
                <div class="profile-container">
                    <div class="profile-left">
                        <div class="profile-main">
                            <div class="col-md-auto col-sm-2 my-auto p-0 profile-pic">                   
                                <button class="btn">
                                    @if($business->user->avatar)
                                        <img src="{{ $business->user->avatar }}" alt="" class="rounded-circle avatar-sm">
                                    @else
                                        <i class="fa-solid fa-circle-user text-secondary profile-sm d-block text-center"></i>
                                    @endif
                                </button>
                            </div>

                            <div class="profile-name">{{$business->user->name}}</div>
                            <div class="col-md-1 col-sm-1 pb-1 p-1">
                                @if($business->user->official_certification == 3)
                                    <img src="{{ asset('images/logo/official_personal.png')}}" class="official-personal d-inline ms-0 avatar-xs" alt="official-personal"> 
                                @endif
                            </div>
                        </div>
                        
                        <!--Follow-->
                        <div class="col-md-1 col-sm-1 ">
                            @if($business->user->isFollowed())
                            {{-- unfollow --}}
                                <form action="{{route('follow.delete', $business->user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-following btn-sm mt-3 w-100">Following</button>
                                </form>
        
                            @else
                            {{-- follow --}}
                            <form action="{{route('follow.store', $business->user->id )}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-follow btn-sm mt-3 w-100">Follow</button>
                            </form>
                            @endif 
                        </div>


                    <div class="profile-icons">
                        {{-- red heart/unlike --}}
                        <div class="mt-3">
                            @if($business->isLiked())                            
                                <form action="{{ route('businesses.like.delete', $business->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn p-0">
                                        <i class="fa-solid fa-heart color-red {{ $business->isLiked() ? '' : 'text-secondary' }}" ></i>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('businesses.like.store', $business->id) }}" method="post">
                                    @csrf
                                    <button type="sumbit" class="btn p-0">
                                        <i class="fa-regular fa-heart"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    <div>
                        <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                            <span>{{ $business->likes->count() }}</span>
                        </button>
                    </div>

                    <!--Comment-->
                    <div class="ms-3 mt-2 p-0">
                        <div>
                            <i class="fa-regular fa-comment h5"></i>
                        </div>
                    </div>
                    <div class="px-0">
                        <span>{{ $business->comments->count()}}</span>
                    </div>

                    <!--Viewer-->
                    <div class="ms-3 p-0">
                        <div>
                            <img src="{{ asset('images/chart.png') }}" alt="">
                        </div>
                    </div>
                    <div class="px-0">
                        <button class="dropdown-item text-dark">
                            0{{-- <span>{{ $post['views_count'] }}</span> --}}
                        </button>
                    </div>

                    <div class="col-md-auto col-sm-12 pe-0 ms-auto profile-update">
                        @if($business->updated_at)
                            <h5 class="card-subtitle">Updated: {{ $business->updated_at->format('M d Y')}}</h5>
                        @else
                            <h5 class="card-subtitle">Posted: {{ $business->created_at->format('M d Y')}}</h5>
                        @endif
                    </div>



                </div>
            </section>

            <!-- Business Promotion -->
            <section class="business-promotion">
                <h3>Business Promotion</h3>
                <div class="promotion-container">
                    @if(count($business_promotion) > 0)
                        <div class="promotion-carousel">
                            <div class="carousel-controls">
                                <button class="carousel-arrow prev" role="button" aria-label="Previous slide">&larr;</button>
                                <button class="carousel-arrow next" role="button" aria-label="Next slide">&rarr;</button>
                            </div>

                            <div class="carousel-items-container">
                                @foreach($business_promotion as $index => $promotion)
                                    <div class="promotion-item {{ $index < 3 ? 'active' : '' }}">
                                        <div class="card promotion-card">
                                            <div class="card-header border-0 bg-light p-3">
                                                <!-- Promotion Title -->
                                                <h4 class="fw-bold">{{ $promotion->title }}</h4>
                                                
                                                <!-- Promotion Period -->
                                                @if((!$promotion->promotion_start || !$promotion->promotion_end))
                                                    <!-- No date specified -->
                                                @elseif($promotion->promotion_start == $promotion->promotion_end)
                                                    <h6 class="fw-bold">{{ date('M d Y', strtotime($promotion->promotion_start)) }}</h6>
                                                @elseif($promotion->promotion_start && $promotion->promotion_end)
                                                    @if(($promotion->promotion_start < $promotion->promotion_end))
                                                        <h6 class="fw-bold">{{ date('M d Y', strtotime($promotion->promotion_start)) }} ~ {{ date('M d Y', strtotime($promotion->promotion_end)) }}</h6>     
                                                    @else
                                                        <h6 class="fw-bold">{{ date('M d Y', strtotime($promotion->promotion_end)) }} ~ {{ date('M d Y', strtotime($promotion->promotion_start)) }}</h6> 
                                                    @endif                              
                                                @endif
                                            </div>
                                            
                                            <!-- Promotion Image -->
                                            <div class="position-relative">
                                                <a href="{{ route('promotions.show', $promotion->id) }}">
                                                    <img src="{{ asset('storage'.$promotion->image) }}" class="card-img-top promotion-img" alt="{{ $promotion->title }}">
                                                </a>
                                            </div>
                                            
                                            <!-- Promotion Description -->
                                            <div class="card-body">
                                                <p class="card-text promotion-description">{{ Str::limit($promotion->introduction, 100) }}</p>
                                                <a href="{{ route('promotions.show', $promotion->id) }}" class="btn btn-sm btn-outline-primary mt-2">check details</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="carousel-indicators">
                                @php
                                    $totalSlides = ceil(count($business_promotion) / 3);
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
                    <h5>Social Media : </h5>
                    <div class="col-auto ms-auto">
                        @if($business->instagram)
                            <a href="#" class="text-decoration-none">
                            <i class="fa-brands fa-instagram text-dark icon-md px-4"></i>
                            </a>
                        @endif
                        @if($business->facebook)
                            <a href="#" class="text-decoration-none">
                            <i class="fa-brands fa-facebook text-dark icon-md px-4"></i>
                            </a>
                        @endif
                        @if($business->x)
                            <a href="#" class="text-decoration-none">
                            <i class="fa-brands fa-x-twitter text-dark icon-md px-4"></i>
                            </a>
                        @endif
                        @if($business->tiktok)
                            <a href="#" class="text-decoration-none">
                            <i class="fa-brands fa-tiktok text-dark icon-md px-4"></i>
                            </a>
                        @endif
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
                            @foreach($business_hour as $hour)
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

            <!-- Business Details -->
            <section class="details-section">
                <h2 class="details-title">
                    Business Details
                </h2>
                <div class="details-container">
                    @foreach($business_info_category as $index => $category)
                        <div class="amenity-group">
                            <div class="amenity-group-title">
                                {{ $category->name }} 
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
                        @if($index < count($business_info_category) - 1)
                            <hr class="amenity-divider" />
                        @endif
                    @endforeach
                </div>
            </section>

            <!-- Business Reviews -->
            <section class="business-reviews">
                <h2 class="business-reviews-title">
                    Business Reviews
                </h2>
                <div class="reviews-container">
                    @if(isset($business->businessComments) && $business->businessComments->count() > 0)
                        <div class="card mb-4">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Latest Reviews</h5>
                            </div>
                            <div class="card-body p-0">
                                @foreach($business->businessComments->take(3) as $comment)
                                    <div class="border-bottom p-4">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                                @if($comment->user->avatar)
                                                    <img src="{{ asset('storage'.$comment->user->avatar) }}" alt="User Avatar" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                                @else
                                                    <i class="fa-solid fa-circle-user text-secondary" style="font-size: 40px;"></i>
                                                @endif
                                                <div class="ms-3">
                                                    <h5 class="mb-0">{{ $comment->user->name }}</h5>
                                                    <small class="text-muted">{{ $comment->created_at->format('Y-m-d H:i') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <p class="mb-2">{{ Str::limit($comment->content, 150) }}</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    @if(Auth::check())
                                                        @if($comment->isLiked())
                                                            <form action="{{ route('business.comments.like.delete', $comment->id) }}" method="post" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm text-danger">
                                                                    <i class="fa-solid fa-heart"></i>
                                                                    <span>{{ $comment->BusinessCommentLikes->count() }}</span>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form action="{{ route('business.comments.like.store', $comment->id) }}" method="post" class="d-inline">
                                                                @csrf
                                                                <button type="submit" class="btn btn-sm text-secondary">
                                                                    <i class="fa-regular fa-heart"></i>
                                                                    <span>{{ $comment->BusinessCommentLikes->count() }}</span>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    @else
                                                        <button class="btn btn-sm {{ $comment->isLiked() ? 'text-danger' : 'text-secondary' }}" disabled>
                                                            <i class="fa-{{ $comment->isLiked() ? 'solid' : 'regular' }} fa-heart"></i>
                                                            <span>{{ $comment->BusinessCommentLikes->count() }}</span>
                                                        </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            No reviews yet.
                        </div>
                    @endif
                    
                    <div class="text-end mb-4">
                        <a href="{{ route('business.comments.showcomments', $business->id) }}" class="btn btn-outline-primary btn-sm">
                            See All Reviews
                        </a>
                    </div>
                    
                    @if(Auth::check())
                        <div class="card mt-4">
                            <div class="card-header bg-white">
                                <h5 class="mb-0">Post Review</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('business.comments.addcomment', $business->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="business_id" value="{{ $business->id }}">
                                    <div class="mb-3">
                                        <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Please write your review..." required>{{ old('content') }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </section>

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