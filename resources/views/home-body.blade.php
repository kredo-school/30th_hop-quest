<style>
    .card{
        position: relative;
        padding-left: 5%; 
        padding-top: 5%;
    }

    .body-image{
        widows: 100%;
        height: auto;
        /* height: 12rem;
        width: 18rem; */
        border-radius: 5px;
    }

    .official{
        position: absolute;
        left: -0.5%;
        top: -0.5%;
        width: 20%;
        height: auto;
    }

    .official-personal{
        width: 1.5rem;
        height: 1.5rem;
        /* width: 20px;
        height: 20px; */
    }

    .card-body{
        display: flow-root
    }

    .card-subtitle{
        font-family: "Raleway", sans-serif;
        font-size: 12px;

    }

    .card-title{
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-icon{
        border-radius: 50%;
        width: 2rem;
        height: 2rem;
        /* width: 30px;
        height: 30px; */
    }

    .card_description{
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 3;
        overflow: hidden;
        text-overflow: ellipsis;
    }


</style>

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card p-3" style="width: 80%;">

                {{-- Card Image with official mark --}}
                <img src="{{ asset('images/Official Badge.png') }}" class="card-img-top official" alt="official">
                <a href="#" class="">
                    <img src="{{ asset('images/金閣寺の紅葉.webp') }}" class="card-img-top body-image" alt="image">
                </a>


                <div class="row align-items-center card-body ps-1">  
                    <div class="row justify-content-between">
                        {{-- Category --}}
                        <div class="col-auto">
                            <h5 class="card-subtitle">Category: <strong>Location</strong></h5>
                        </div>
                        
                        {{-- Postdate --}}
                        <div class="col-auto">
                            <h5 class="card-subtitle">2025/2/25</h5>
                        </div>
                    </div>                

                    
                    {{-- Title --}}
                    <div class="mt-2">
                        <a href="#" class="text-decoration-none" style="color: black">
                            <h4 class="card-title" id="card-title"><strong>Kinkakuji Temple of Kyoto</strong></h4>
                        </a>
                    </div>

                    {{-- Icon & Name & Official mark --}}
                    <div class="d-flex flex-wrap align-items-center mt-2 ps-3 pe-4 personal_space">

                        {{-- User Icon --}}
                        <div class="col-auto">
                            <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                                <img src="{{ asset('images/ab67706c0000da84dd49124b694e60d6a1dd1f77.jpg')}}" class="card-icon" alt="card-icon">
                            </a>
                        </div>

                        {{-- User Name --}}
                        <div class="col-auto ms-2 pt-2">
                            <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                                <h1 class="username h5" id="username">Bruno Marsdddddddddd</h1>
                            </a>
                        </div>

                        {{-- Javascript for character limit --}}
                        <script>
                            const usernameElem = document.getElementById('username');
                            const text = usernameElem.textContent;
                            if (text.length > 12){
                                usernameElem.textContent = text.substring(0, 12) + "...";
                            }
                        </script>

                        {{-- User official mark --}}
                        <div class="col-auto pb-2">
                            <img src="{{ asset('images/名称未設定のデザイン (8) 1.png')}}" class="official-personal ms-2" alt="official-personal">
                        </div>

                        {{-- Follow Button --}}
                        <div class="col-auto ms-auto pb-2">
                            <form action="#" method="post" class="">
                                @csrf
                                
                                <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                            </form>
                        </div>
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
        </div>
    </div>
</div>
