<link rel="stylesheet" href="{{asset('css/style.css')}}"> 
<!-- Header image -->
    <div class="row">
        <div class="mb-3 px-0 pt-3">
            <img src="{{ asset('images/resort.jpg') }}" class="header-image"  alt="">
        </div>
    </div> 
{{-- User information --}}
<div class="row justify-content-center mt-0">        
    <div class="col-8">
        <div class="profile-header position-relative"> 
            <div class="row">
                <!-- Avatar image -->
                <div class="col-auto profile-image">
                    <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-xl"></i>
                </div>
                
                <!-- Username -->
                <div class="col">
                    <div class="row">
                        <div class="col-8">
                            <h3 class="mb-1 text-truncate">HopQuest Hotel</h3>
                        </div>
                        <div class="col-2">
                            <a href="{{route('profile.edit')}}" class="btn btn-sm btn-green mb-2 w-100">EDIT</a>
                        </div>
                        <div class="col-2">
                            <button class="btn btn-sm btn-red mb-2 w-100 " data-bs-toggle="modal" data-bs-target="#delete-profile">DELETE</button>
                        </div>
                    </div>  
                    @include('businessusers.profiles.modals.delete')  
                
                    {{-- url --}}
                    <div class="row mb-3">
                        <div class="col">
                            <a href="#" class="text-decoration-none text-dark ">www.hopquest-hotel.com</a>
                        </div>
                    </div> 
                    
                    {{-- items --}}
                    <div class="row mb-3">
                        <div class="col-auto">
                            <a href="{{ route('profile') }}" class="text-decoration-none text-dark fw-bold">3 posts</a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('profile.followers') }}" class="text-decoration-none text-dark fw-bold">5 followers</a>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('profile.reviews')}}" class="text-decoration-none text-dark fw-bold">7 reviews</a>
                        </div>

                        {{-- SNS icons --}}
                        <div class="col-auto ms-auto">
                            <a href="#" class="text-decoration-none">
                            <i class="fa-brands fa-instagram text-dark icon-md px-4"></i>
                            </a>
                        
                            <a href="#" class="text-decoration-none">
                            <i class="fa-brands fa-facebook text-dark icon-md px-4"></i>
                            </a>
                        
                            <a href="#" class="text-decoration-none">
                            <i class="fa-brands fa-x-twitter text-dark icon-md px-4"></i>
                            </a>
                        
                            <a href="#" class="text-decoration-none">
                            <i class="fa-brands fa-tiktok text-dark icon-md px-4"></i>
                            </a>
                        </div>
                    </div>
                </div> 
            </div>
            {{-- introduction --}}
            <div class="row mb-3">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti ea, adipisci enim neque explicabo doloribus qui aut nemo odit officia a reiciendis, magni beatae voluptates alias deserunt minus maiores! Porro quod vero consequuntur minima amet cum quos quaerat. Quisquam nesciunt natus explicabo quod magnam eum veniam laboriosam consectetur voluptatem suscipit! Lorem ipsum dolor sit amet consectetur adipisicing elit. Porro quibusdam similique temporibus sunt error. Exercitationem labore soluta doloribus itaque qui!</p>
            </div>
            
        </div>
    </div>
    
</div>




