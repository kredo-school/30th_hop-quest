@section('css')
    <link rel="stylesheet" href="{{ asset('css/post-body.css')}}">
@endsection


    <div class="card p-3">
        <div class="card-header border-0 bg-light p-0 overflow-hidden">
            {{-- Card Image with official mark --}}
            {{-- <img src="{{ asset('images/Official Badge.png') }}" class="official" alt="official"> --}}
            <a href="#" class="">
                <img src="{{ asset('images/kinkakuji.jpg') }}" class="card-img-top post-image" alt="image">
            </a>
        </div>

        <div class="card-body content">  
            <div class="row mb-3">
                {{-- Category --}}
                <div class="col-auto p-0">
                    <h5 class="card-subtitle">Category: <strong>Location</strong></h5>
                </div>
                
                {{-- Postdate --}}
                <div class="col-auto pe-0 ms-auto">
                    <h5 class="card-subtitle">2025/2/25</h5>
                </div>
            </div>                

            
            {{-- Title --}}
            <div class="row mb-2">
                <div class="col p-0">
                    <a href="#" class="text-decoration-none">
                        <h4 class="card-title text-dark fw-bold">Kinkakuji Temple of Kyoto</h4>
                    </a>
                </div>
            </div>
            {{-- Icon & Name & Official mark --}}
            <div class="row align-items-center personal_space">
                {{-- User Icon --}}
                <div class="col-auto my-auto">
                    <a href="#" class="text-decoration-none h5 d-flex align-items-center">
                        <img src="{{ asset('images/tom.jpg') }}" alt="" class="rounded-circle avatar-sm">
                        {{-- <i class="fa-solid fa-circle-user text-secondary d-block text-center icon-md"></i> --}}
                    </a>
                </div>
            
                {{-- User Name --}}
                <div class="col-auto ms-0 ">
                    <a href="#" class="text-decoration-none h5 d-inline align-items-center">
                        <p class="username h5" id="username">Tom Cruise top gun</p></a>
                   
                </div>

                {{-- Javascript for character limit --}}
                <script>
                    document.querySelectorAll('.username').forEach(elem => {     //変更①　idではなくclassから引っ張ってくる。
                        const text = elem.textContent;   //変更②　前まではusernameElemという変数を使っていましたが、上記の理由からただのelemに変更。
                        if (text.length > 12){
                        elem.textContent = text.substring(0, 12) + "...";　//変更③　変更②と同じ修正です。
                        }
                    });
                </script>
                {{-- <script>
                    const usernameElem = document.getElementById('username');
                    const text = usernameElem.textContent;
                    if (text.length > 12){
                        usernameElem.textContent = text.substring(0, 12) + "...";
                    }
                </script> --}}

                {{-- User official mark --}}
                <div class="col-auto pb-2">
                    <img src="{{ asset('images/logo/official_personal.png')}}" class="official-personal d-inline ms-0" alt="official-personal"> 
                </div>

                {{-- Follow Button --}}
                <div class="col-auto ms-auto my-auto">
                    <form action="#" method="post" class="">
                        @csrf                       
                        <button type="submit" class="btn btn-sm btn-follow-body">Follow</button>
                    </form>
                </div>
            </div>
            
            {{-- Heart icon & Like function --}}
            <div class="row align-items-center ">
                <div class="col-1 ms-2 p-0">
                    <form action="#" method="post">
                        @csrf      
                        <button type="submit" class="btn btn-sm shadow-none">
                            <i class="fa-regular fa-heart pt-3"></i>
                        </button>
                    </form>
                </div>
                <div class="col-2 ms-1 px-2">
                    <button class="dropdown-item text-dark" data-bs-toggle="modal" data-bs-target="#">
                        10
                    </button>
                </div>
                {{-- Modal for displaying all users who liked owner of post--}}
                                                                
                {{-- Comment icon & Number of comments --}}
                <div class="col-1 ms-3 p-0">
                    <div>
                        <i class="fa-regular fa-comment"></i>
                    </div>
                </div>
                <div class="col-2 ms-1 px-0">
                    <button class="dropdown-item text-dark">
                        52
                    </button>
                </div>

                {{-- Number of viewers --}}
                <div class="col-1 ms-3 p-0">
                    <div>
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                </div>
                <div class="col-2 ms-1 px-0">
                    <button class="dropdown-item text-dark">
                        201
                    </button>
                </div>
            </div>

            {{-- Description of posts --}}
            <div class="row">
                <div class="col p-0">
                    <p class="card_description">
                        Kinkakuji (金閣寺, Golden Pavilion) is a Zen temple in northern Kyoto whose top two floors are completely covered in gold leaf. Formally known as Rokuonji, the temple was the retirement villa of the shogun Ashikaga Yoshimitsu, and according to his will it became a Zen temple of the Rinzai sect after his death in 1408. Kinkakuji was the inspiration for the similarly named Ginkakuji (Silver Pavilion), built by Yoshimitsu's grandson, Ashikaga Yoshimasa, on the other side of the city a few decades later.
                    </p>
                </div>    
            </div>
        </div>
    </div>
