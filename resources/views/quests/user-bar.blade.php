<div class="bg-white rounded-3 mb-1">
    {{-- Update  date --}}
    <div class="col-auto pt-0 justify-content-center">
        <p class="xsmall text-secondary p-0 pe-2 text-end pt-lg-2 d-md-none">UPDATE: 2024/12/24</p>
    </div>
    {{-- Icon & Name & Official mark --}}
    <div class="d-flex flex-wrap align-items-center justify-content-center">

        {{-- User Icon --}}
        <div class="col-auto m-2">
            <a href="#" class="text-decoration-none h5 d-flex align-items-center my-0">
                <img src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" class="avatar-md rounded-circle ms-0 ms-md-2" alt="icon">
            </a>
        </div>

        {{-- User Name --}}
        <div class="col-md ms-3 pt-3">
            <div class="row my-0">
                <div class="col-auto px-0">
                    <a href="#" class="text-decoration-none h5 d-flex align-items-center mb-0 pt-1">
                    <h1 class="username h5 poppins-semibold mb-0" id="username">Mickey Mouse</h1>
                    </a>
                </div>
                {{-- User official mark --}}
                <div class="col-auto px-0">
                    <div class="col-auto p-0">
                        <img src="{{ asset('images/logo/official_personal.png')}}" class="avatar-xs ms-2" alt="official-personal">
                    </div>
                </div>
                {{-- Follow Button --}}
                <div class="col-auto ps-md-3 mt-0 d-inline">
                    <form action="#" method="post" class="d-inline-block">
                        @csrf
                        <button type="submit" class="btn btn-lg btn-follow py-0">Follow</button>
                    </form>
                </div>
            </div>
    {{-- Heart icon & Like function --}}
            <div class="row pb-2 ps-1">
                <div class="d-flex align-items-center ps-0">
                    <form action="#" method="post">
                        @csrf

                        <button type="submit" class="btn btn-sm shadow-none">
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
        <div class="col-4">
            {{-- Update  date --}}
            <div class="col-auto pt-0">
                <p class="xsmall text-secondary p-0 pe-2 text-end d-none d-md-block">UPDATE: 2024/12/24</p>
            </div>
            {{-- SNS icons --}}
            <div class="row justify-content-center">
                <div class="col-auto d-flex py-2">
                    <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-instagram text-dark icon-md px-0 mx-1 d-sm-block d-none"></i>
                    <i class="fa-brands fa-instagram text-dark icon-sm px-0 me-1 d-sm-none"></i>
                    </a>
                
                    <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-facebook text-dark icon-md px-0 mx-1 d-sm-block d-none"></i>
                    <i class="fa-brands fa-facebook text-dark icon-sm px-0 mx-1 d-sm-none"></i>
                    </a>
                
                    <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-x-twitter text-dark icon-md px-0 mx-1 d-sm-block d-none"></i>
                    <i class="fa-brands fa-x-twitter text-dark icon-sm px-0 mx-1 d-sm-none"></i>
                    </a>
                
                    <a href="#" class="text-decoration-none">
                    <i class="fa-brands fa-tiktok text-dark icon-md px-0 mx-1 d-sm-block d-none"></i>
                    <i class="fa-brands fa-tiktok text-dark icon-sm px-0 mx-1 d-sm-none"></i>
                    </a>
                </div>
            </div>
                {{-- Update  date
                <div class="col-lg-auto pt-0 justify-content-center">
                    <p class="xsmall text-secondary p-0 pb-5 pe-2 text-center pt-lg-2 d-xl-block d-none">UPDATE: 2024/12/24</p>
                </div> --}}
            </div>
    </div>

</div>