<!-- Comments Section -->
    <div class="d-flex justify-content-start mt-2">    
        <h5 class="font-normal" style="align-items: left;">
        Comments(1)
        </h5>
    </div>

<div class="mx-auto mt-2" style="width: 70%;">
    <div class="w-full mt-2">
        <textarea class="w-full border border-gray-300 rounded p-1" style="width: 100%;" placeholder="your comment"></textarea>
        <div class="flex justify-center mb-4">
            <button class="btn-follow">SEND</button>
        </div>
    </div>

    {{-- comment section1 --}}
    <div class="w-full border-none shadow-none mb-4">
        <div class="flex items-start bg-white rounded p-4">
            {{-- Icon & Name & Official mark --}}
            <div class="d-flex flex-wrap align-items-center w-full">
                {{-- User Icon --}}
                <div class="col-auto ms-1 pt-2" id="usericon">
                    <a href="#" class="text-decoration-none d-flex align-items-center">
                    <img src="{{ asset('images/spot_sample/image.png')}}" class="avatar-xs" alt="card-icon">
                    </a>
                </div>

                {{-- User Name --}}
                <div class="col-auto ms-1 pt-2" id="touristname">
                    <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                    <h1 class="username h6" id="username"><strong>Bruno Mars</strong></h1>
                    </a>
                </div>
                
                <div class="col-auto ms-1 pt-2" id="date">
                    <p class="text-decoration-none d-flex align-items-center">
                    2025.02.11&nbsp;&nbsp;&nbsp;&nbsp;17:25
                    </p>
                </div>

                <!-- trash icon -->
                <div class="col-auto d-flex ms-auto pt-2" id="trash-icon">
                    <button class="btn btn-sm p-0 text-center">
                    <i class="fa-solid fa-trash"></i>
                    </button>
                </div>   
            </div>

            {{-- content of comment --}}
            <div class="ml-1 text-left" id="content">
                <p class="text-decoration-none" style="text-align: left;">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi tempore libero distinctio nesciunt quisquam doloremque commodi! Quae dolore repudiandae optio iste veritatis et odio, labore consequuntur tenetur, sint a beatae!
                </p>
            </div>

            {{-- content of indicate --}}
            <div class="d-flex align-items-center">
                {{-- Heart icon & Like function --}}
                <div class="col-auto d-flex ms-3">
                    <form action="#" method="post">
                        @csrf

                        <button type="submit" class="btn btn-sm shadow-none">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                    </form>

                    <button class="btn btn-sm p-0 text-center">
                        <span>10</span>
                    </button>
                </div>                                     
                {{-- Comment icon & Number of comments --}}
                <div class="col-auto d-flex ms-3">
                    <div>
                        <i class="fa-regular fa-comment"></i>
                    </div>
                    <button class="btn btn-sm p-0 text-center">
                        <span>&nbsp;&nbsp;52</span>
                    </button>
                </div>
                {{-- View icon &  Number of view --}}
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

    {{-- comment section2 --}}
    <div class="w-full border-none shadow-none mb-4">
        <div class="flex items-start bg-white rounded p-4">
            {{-- Icon & Name & Official mark --}}
            <div class="d-flex flex-wrap align-items-center w-full">
                {{-- User Icon --}}
                <div class="col-auto ms-1 pt-2" id="usericon">
                    <a href="#" class="text-decoration-none d-flex align-items-center">
                    <img src="{{ asset('images/spot_sample/image.png')}}" class="avatar-xs" alt="card-icon">
                    </a>
                </div>

                {{-- User Name --}}
                <div class="col-auto ms-1 pt-2" id="touristname">
                    <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                    <h1 class="username h6" id="username"><strong>Bruno Mars</strong></h1>
                    </a>
                </div>
                
                <div class="col-auto ms-1 pt-2" id="date">
                    <p class="text-decoration-none d-flex align-items-center">
                    2025.02.11&nbsp;&nbsp;&nbsp;&nbsp;17:25
                    </p>
                </div>

                <!-- trash icon -->
                <div class="col-auto d-flex ms-auto pt-2" id="trash-icon">
                    <button class="btn btn-sm p-0 text-center">
                    <i class="fa-solid fa-trash"></i>
                    </button>
                </div>   
            </div>

            {{-- content of comment --}}
            <div class="ml-1 text-left" id="content">
                <p class="text-decoration-none" style="text-align: left;">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eligendi tempore libero distinctio nesciunt quisquam doloremque commodi! Quae dolore repudiandae optio iste veritatis et odio, labore consequuntur tenetur, sint a beatae!
                </p>
            </div>

            {{-- content of indicate --}}
            <div class="d-flex align-items-center">
                {{-- Heart icon & Like function --}}
                <div class="col-auto d-flex ms-3">
                    <form action="#" method="post">
                        @csrf

                        <button type="submit" class="btn btn-sm shadow-none">
                            <i class="fa-regular fa-heart"></i>
                        </button>
                    </form>

                    <button class="btn btn-sm p-0 text-center">
                        <span>10</span>
                    </button>
                </div>                                     
                {{-- Comment icon & Number of comments --}}
                <div class="col-auto d-flex ms-3">
                    <div>
                        <i class="fa-regular fa-comment"></i>
                    </div>
                    <button class="btn btn-sm p-0 text-center">
                        <span>&nbsp;&nbsp;52</span>
                    </button>
                </div>
                {{-- View icon &  Number of view --}}
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
