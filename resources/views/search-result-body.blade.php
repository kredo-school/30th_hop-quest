@section('css')
    <link rel="stylesheet" href="{{ asset('css/search-body.css')}}">
@endsection

{{-- @extends('layouts.app') --}}
    <div class="card p-3">

        {{-- Card Image with official mark --}}
        <img src="{{ asset('images/Official Badge.png') }}" class="official" alt="official">
        <a href="#" class="">
            <img src="{{ asset('images/金閣寺の紅葉.webp') }}" class="card-img-top body-image" alt="image">
        </a>


        <div class="row align-items-center card-body ps-1">  
            <div class="row justify-content-between ms-1">
                {{-- Category --}}
                <div class="col-auto p-0">
                    <h5 class="card-subtitle">Category: <strong>Location</strong></h5>
                </div>
                
                {{-- Postdate --}}
                <div class="col-auto pe-0">
                    <h5 class="card-subtitle">2025/2/25</h5>
                </div>
            </div>                

            
            {{-- Title --}}
            <div class="mt-2">
                <a href="#" class="text-decoration-none">
                    <h4 class="card-title text-dark"><strong>Kinkakuji Temple of Kyoto</strong></h4>
                </a>
            </div>

            {{-- Icon & Name & Official mark --}}
            <div class="d-flex flex-wrap align-items-center personal_space">

                {{-- User Icon --}}
                <div class="col-auto ms-1">
                    <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                        <img src="{{ asset('images/ab67706c0000da84dd49124b694e60d6a1dd1f77.jpg')}}" class="card-icon" alt="card-icon">
                    </a>
                </div>

                {{-- User Name --}}
                <div class="col-auto ms-1 pt-2">
                    <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                        <h1 class="username h5"><strong>Bruno Marsdddddddddd</strong></h1>
                    </a>
                </div>

                {{-- Javascript for character limit --}}
                <script>
                    document.querySelectorAll('.username').forEach(elem => {
                        const text = elem.textContent;

                        if (text.length > 10){
                        elem.textContent = text.substring(0, 10) + "...";
                        }
                    });
                </script>

                {{-- User official mark --}}
                <div class="col-auto pb-2">
                    <img src="{{ asset('images/名称未設定のデザイン (8) 1.png')}}" class="official-personal ms-2" alt="official-personal">
                </div>

                {{-- Follow Button --}}
                {{-- <div class="col-auto pb-2 ms-auto">
                    <form action="#" method="post" class="">
                        @csrf
                        
                        <button type="submit" class="btn btn-sm btn-follow-body">Follow</button>
                    </form>
                </div> --}}
            </div>
            
            {{-- Heart icon & Like function --}}
            <div class="d-flex align-items-center">
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

            {{-- Description of posts --}}
            <div>
                <p class="card_description">
                    Kinkakuji (金閣寺, Golden Pavilion) is a Zen temple in northern Kyoto whose top two floors are completely covered in gold leaf. Formally known as Rokuonji, the temple was the retirement villa of the shogun Ashikaga Yoshimitsu, and according to his will it became a Zen temple of the Rinzai sect after his death in 1408. Kinkakuji was the inspiration for the similarly named Ginkakuji (Silver Pavilion), built by Yoshimitsu's grandson, Ashikaga Yoshimasa, on the other side of the city a few decades later.
                </p>
            </div>
        </div>
    </div>