@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="css/add-quest.css">
@endsection

@section('title', 'Add Quest - confirmation')

@section('content')
<div class="bg-green">
    <div class="container py-5 col-9 px-0">
        <h3 class="color-navy poppins-semibold text-center">Check Your Quest</h3>

        <section class="position-relative my-5" id="header">
            <img src="{{asset('images/quest/pexels-pixabay-459203_optimized_.jpg')}}" alt="header-img" id="header-img" class="img-fluid w-100">
        
            <!-- 右上のオーバーレイ部分 -->
            <div class="overlay position-absolute top-0 end-0 p-3 text-white">
                <!-- 編集・削除ボタン -->
                <div>
                    <button class="btn btn-sm btn-green"><a href="#form1" class="text-decoration-none text-white"><i class="fa-solid fa-pen-to-square"></i></a></button>
                    <button class="btn btn-sm btn-red" data-bs-toggle="modal" data-bs-target="#delete-post"><i class="fa-solid fa-trash"></i></button>
                </div>
            </div>
            <div class="overlay position-absolute bottom-0 start-0 p-3 text-white">
                <!-- タイトル -->
                <h3 class="my-0" id="header-title">Japan - Kyoto 15days Fun Trip!</h3>
                <!-- 日付 -->
                <h4 class="my-0" id="header-dates">2025/01/01 - 2025/01/15</h4>
                <!-- 紹介文 -->
                <p class="m-0 p-0" id="header-intro">with my family! this is my sisters birthday trip!</p>
            </div>
        </section>
{{-- DELETE MODAL --}}
        <div class="modal fade" id="delete-post">
            <div class="modal-dialog">
                <div class="modal-content border-red">
                    <div class="modal-header">
                        <h3 class="h3"> <i class="fa-solid fa-trash"></i> Delete Post</h3>
                    </div>
                    <div class="modal-body">
                        <p> Are you sure you want to delete this post?</p>
                        {{-- <img src="{{ $post->image }}" alt="" class="img-lg"> --}}
                        <p class="text-center">POST TITLE</p>
                    </div>
                    <div class="modal-footer border-0">
                        <form action="" method="">
                            {{-- {{ route('admin.posts.hide', $post->id) }} --}}
                            @csrf
                            @method('DELETE')
                            <button type="button" data-bs-dismiss="modal" class="btn btn-sm btn-outline-red">Cancel</button>
                            <button type="submit" class="btn btn-sm btn-red">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

{{-- ---------------------------@yeild user information --}}
        <div class="container mt-4">
            <div class="row justify-content-between mt-4">
                <!-- 左側: Quest - Agenda -->
                <div class="col-md-6 col-lg-5 bg-white rounded-3 mb-4" id="agenda-list">
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
                </div>
            </div>
            
        </div>
    
            <section id="day-template" class="container bg-white my-5 rounded-3 p-3 border-red">
                <div class="row px-0">
                    <p class="color-red fs-3 text-center" id="day-number">Day 2</p>
                </div>
                <div class="row px-3">
                    <h4 class="col-md-10 spot-name text-start poppins-bold px-0" id="spot-name">SPOT NAME</h4>
                        <!-- 編集・削除ボタン -->
                        <div class="col ms-0 text-end pe-0">
                            <button class="btn btn-sm btn-green"><a href="#form1" class="text-decoration-none text-white"><i class="fa-solid fa-pen-to-square"></i></a></button>
                            <button class="btn btn-sm btn-red" data-bs-toggle="modal" data-bs-target="#delete-post"><i class="fa-solid fa-trash"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-end">
                            <div class="form-check form-check-inline me-0">
                                <input type="checkbox" name="day-agenda" id="day-agenda" class="form-check-input">
                                <label for="day-agenda" class="xsmall">Agenda</label>
                            </div>
                        </div>
                    </div>

                <div class="row px-0">
                    <div class="col-md-6 spot-image-container">
                        <img  src="{{asset('images/quest/pexels-pixabay-459203.jpg')}}" alt="" class="spot-image img-fluid image-thumbnail" id="spot-image">
                        <img  src="{{asset('images/quest/pexels-pixabay-459203.jpg')}}" alt="" class="spot-image img-fluid image-thumbnail" id="spot-image">
                        <img  src="{{asset('images/quest/pexels-pixabay-459203.jpg')}}" alt="" class="spot-image img-fluid image-thumbnail" id="spot-image">
                    </div>
                    <div class="col-md-6 mt-4 mt-md-0">
                        <p class="spot-description w-100" id="spot-description">Description Here------Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.</p>
                    </div>
                </div>
            </section>
            
            
            <button class="btn btn-navy w-100 mb-5" id="sybmitBtn"><a href="" class="text-decoration-none text-white">Check</a></button>
        </div>
    </div>
</div>
</body>
</html>

@vite(['resources/js/quest/scroll-adjustment.js'])
@endsection
