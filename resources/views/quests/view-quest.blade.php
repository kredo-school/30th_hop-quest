@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/add-quest.css">
@endsection

@section('title', 'Quest')

@section('content')
<div class="bg-green">
    <div class="container py-4 col-9 px-0">
    <section class="position-relative my-5" id="header">
            <img src="{{asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="header-img" id="header-img" class="img-fluid w-100">
        
            <div class="overlay position-absolute bottom-0 start-0 p-3 text-white">
                <!-- タイトル -->
                <h3 class="my-0" id="header-title">Japan - Kyoto 15days Fun Trip!</h3>
                <!-- 日付 -->
                <h4 class="my-0" id="header-dates">2025/01/01 - 2025/01/15</h4>
                <!-- 紹介文 -->
                <p class="m-0 p-0" id="header-intro">with my family! this is my sisters birthday trip!</p>
            </div>
     </section>

     <section>
        @include('quests.user-bar')
            
     </section>

        <div class="container mt-5">
            <div class="row justify-content-between mt-4">
                <!-- 左側: Quest - Agenda -->
                <div class="col-md-5 col-lg-5 bg-white rounded-3 mb-4" id="agenda-list">
                    <h4>Quest - Agenda</h4>
                    <ul>
                        <li class="day-tag">Day - 1
                            <ul>
                                <li>- Kinkakuji-Temple</li>
                            </ul>
                        </li>
                        <li class="day-tag">Day - 2
                            <ul>
                                <li>- Kinkakuji-Temple</li>
                            </ul>
                        </li>
                        <li class="day-tag">Day - 3
                            <ul>
                                <li>- Kinkakuji-Temple</li>
                            </ul>
                        </li>
                        <li class="day-tag">Day - 4
                            <ul>
                                <li>- Kinkakuji-Temple</li>
                            </ul>
                        </li>
                    </ul>
                </div>
            
                <!-- 右側: Googleマップ -->
                <div class="col-md-6 col-lg-6 px-0">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3925.146784010381!2d123.903637375094!3d10.33013598979281!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9992189a343c3%3A0xa7758b38dbbe1750!2sQQEnglish%20IT%20Park%20Campus!5e0!3m2!1sja!2sph!4v1742469854398!5m2!1sja!2sph" 
                        width="100%" 
                        height="300" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>{{-- </div> --}}
            </div>
        </div>
    
        <section id="day-template" class="container bg-white my-5 rounded-3 p-3 border-red">
            <div class="row px-0">
                <p class="color-red fs-3 text-center" id="day-number">Day 2</p>
            </div>
            <div class="row px-3">
                <h4 class="col-md-10 spot-name text-start poppins-bold px-0" id="spot-name">SPOT NAME</h4>

            <div class="row px-0">
                <div class="col-md-6 spot-image-container">
                    <img  src="{{asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="" class="spot-image img-fluid image-thumbnail" id="spot-image">
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <p class="spot-description w-100" id="spot-description">Description Here------Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quamisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.</p>
                </div>
            </div>
        </section>
        <section id="day-template" class="container bg-white my-5 rounded-3 p-3 border-red">
            <div class="row px-0">
                <p class="color-red fs-3 text-center" id="day-number">Day 2</p>
            </div>
            <div class="row px-3">
                <h4 class="col-md-10 spot-name text-start poppins-bold px-0" id="spot-name">SPOT NAME</h4>

            <div class="row px-0">
                <div class="col-md-6 spot-image-container">
                    <img  src="{{asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="" class="spot-image img-fluid image-thumbnail d-block" id="spot-image">
                    <img  src="{{asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="" class="spot-image img-fluid image-thumbnail d-block" id="spot-image">
                    <img  src="{{asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="" class="spot-image img-fluid image-thumbnail d-block" id="spot-image">
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <p class="spot-description w-100" id="spot-description">Description Here------Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quamisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quamisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.</p>
                </div>
            </div>
        </section>

        <section>
            <div class="bg-white rounded-3 mb-4">
                <div class="row px-2 py-3 m-0">
                    <div class="col">
                        <img src="{{ asset('images/quest/pexels-pixabay-459203_optimized_.jpg') }}" alt="" class="rounded-circle avatar-sm">
                    </div>
                </div>
            </div>
         </section>

        </div>
    </div>
    
</div>

</body>
</html>

@vite(['resources/js/quest/scroll-adjustment.js'])
@endsection
