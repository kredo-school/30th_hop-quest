<style>
    .card{
        position: relative;
        padding-left: 5%; 
        padding-top: 5%;
    }

    .body-image{
        height: 12rem;
        width: 18rem;
        border-radius: 5px;
    }

    .official{
        position: absolute;
        left: 1%;
        top: 1%;
        width: 60px;
        height: 60px;
    }

    .official-personal{
        width: 20px;
        height: 20px;
    }

    .card-body{
        display: flow-root
    }

    .card-subtitle{
        font-family: "Raleway", sans-serif;
        font-size: 12px;

    }

    .card-title{
        line-height: 0px;
    }

    .card-icon{
        border-radius: 50%;
        width: 30px;
        height: 30px;
    }

</style>

<div class="container">
    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 80%;">

                {{-- Card Image with official mark --}}
                <img src="{{ asset('images/Official Badge.png') }}" class="card-img-top official" alt="official">
                <img src="{{ asset('images/金閣寺の紅葉.webp') }}" class="card-img-top body-image" alt="image">

                <div class="row card-body ps-1">

                    
                {{-- Category --}}
                    <div class="col-6">
                        <h6 class="card-subtitle">Category: <strong>Location</strong></h6>
                    </div>
                
                {{-- Postdate --}}
                    <div class="col-5 postdate">
                        2025/2/25
                    </div>
                
                {{-- Title --}}
                    <h5 class="card-title">XXXX XXXXX</h5>

                {{-- Icon & Name & Official mark --}}
                    <div class="d-flex align-items-center ps-3">
                        <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                            <img src="{{ asset('images/ab67706c0000da84dd49124b694e60d6a1dd1f77.jpg')}}" class="card-icon" alt="card-icon"> 
                            &nbsp;Bruno Mars
                            <img src="{{ asset('images/名称未設定のデザイン (8) 1.png')}}" class="official-personal ms-2" alt="official-personal">
                        </a>

                {{-- Follow Button --}}
                        <form action="#" method="post" class="ms-5">
                            @csrf
                            
                            <button type="submit" class="btn btn-primary btn-sm">Follow</button>
                        </form>
                    </div>
                
                {{-- Like & Comment & Number of viewers --}}
                    <div class="col-auto d-flex align-items-center">
                        <form action="#" method="post">
                            @csrf
    
                            <button type="submit" class="btn btn-sm shadow-none">
                                <i class="fa-regular fa-heart"></i>
                            </button>
                        </form> 
                    </div>
                    
                    <div class="col-auto">
                        <button class="btn">
                            <span>10</span>
                        </button>

                        {{-- Modal for displaying all users who liked owner of post--}}
                        

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
