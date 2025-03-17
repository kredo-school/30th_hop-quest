@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/add-quest.css') }}">
@endsection

@section('title', 'Add Quest')

@section('content')
<div class="bg-green">
    <div class="container py-5 col-9">
        <h3 class="color-navy poppins-semibold text-center">Create Your Quest</h3>
    
        <section id="form1">
            <form action="" method="" enctype="multipart/form-data" class="bg-white rounded-4 p-5 my-3">
                @csrf
                    <div class="row pb-3">
                        <label for="title" class="form-label">Quest Title</label>
                        <input type="text" name="title" id="title" class="input-box" placeholder="Kyoto Trip">
                    </div>

                    <div class="row pb-3">
                        <div class="col-5 px-0">
                        <label for="start_date" class="form-label">Start date</label>
                        <input type="date" name="start_date" id="start_date" class="input-box">
                        </div>
                        <div class="col d-flex align-items-end justify-content-center">
                            <i class="fa-solid fa-caret-right icon-md"></i>
                        </div>
                        <div class="col-5 px-0">
                            <label for="end_date" class="form-label">End date</label>
                            <input type="date" name="end_date" id="end_date" class="input-box form-control">
                        </div>
                    </div>
                    <div class="row pb-3">
                        <label for="intro" class="form-label">Introduction</label>
                        <input type="text" name="intro" id="intro" class="input-box" placeholder="3 days trip with my family!">
                    </div>
                    <div class="row pb-3">
                        <label for="h_photo" class="form-label">Header photo</label>
                        <div class="col-9 ps-0">
                            <input type="file" name="h-photo" id="h_photo" class="custom-file-input form-control">
                        </div>
                        <div class="col-3 ms-auto pe-0">
                            <label for="h_photo" class="btn btn-green custom-file-label w-100"><i class="fa-solid fa-plus icon-xs d-inline"></i>Photo</label>
                        </div>
                            <p class="mt-0 ps-0 pb-0 xsmall">
                                Acceptable formats: jpeg, jpg, png, gif only.<br>Max size is 1048 KB
                            </p>
                    </div>
                    <div class="row">
                        <button type="submit" name="submit1" id="submit1" class="btn btn-navy">Create</button>
                    </div>

            </form>
        </section>   

        <section id="form2" class="d-none">
            <form action="" method="" enctype="multipart/form-data" class="bg-white rounded-5 px-5 py-3 my-5">
                @csrf
                <div class="row">
                    <label for="day_select" class="form-label">Choose the day</label>
                    <select id="day_select" name="day_select" class="w-25 p-2 border rounded mb-3">
                        <option value="1">Day1</option>
                        <option value="2">Day2</option>
                        <option value="3">Day3</option>
                    </select>
                    
                </div>
                <div class="row">
                    <div class="col-md-5 p-0">
                        <label for="spot-name" class="form-label">Search Spot on HopQuest</label>
                    </div>
                    <div class="col-md-2">
                        
                    </div>
                    <div class="col-lg-5 d-none d-lg-block px-0">
                        <p class="m-0 px-0 xsmall">No spot on HopQuest? Tell us your fav spot!</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-5 px-0">
                        <form action="" method="get">
                            @csrf
                            <input type="text" name="search" id="spot-name" value="" placeholder="Tokyo Tower" class="input-box ms-auto w-100">
                        </form>
                    </div>
                    <div class="col-lg-2">
                        <p class="m-0 fs-4 text-center fw-bold">or</p>
                    </div>
                    <div class="col-lg-5 px-0">
                        <p class="m-0 p-0 xsmall d-lg-none">No spot on HopQuest? Tell us your fav spot!</p>
                        <a href="" class="btn btn-blue w-100"><i class="fa-solid fa-plus icon-xs d-inline"></i>ADD SPOT</a>
                    </div>
                
                    <div class="row pb-3 px-0 mx-0 mt-3">
                        <label for="spot-images" class="form-label">Photos</label>
                        <div class="col-9 ps-0">
                            <input type="file" name="spot-images" id="spot-images" class="custom-file-input form-control ms-0" multiple>
                        </div>
                        <div class="col-3">
                            <button class="btn btn-green custom-file-label w-100" id="upload-btn">
                                <i class="fa-solid fa-plus icon-xs d-inline"></i>Photo
                            </button>
                        </div>
                        <p class="mt-0 ps-0 xsmall">
                            Acceptable formats: jpeg, jpg, png, gif only.<br>Max size is 1048 KB
                        </p>
                    </div>
                    
                    <!-- 📌 アップロードした画像のファイル名を表示するエリア -->
                    <div id="uploaded-file-names" class="mt-2"></div>
                    
                    <div class="row pb-3 mx-0 ps-0">
                        <label for="spot-description" class="form-label">Description</label>
                        <textarea id="spot-description" class="text-area" rows="5" placeholder="How was your expericence there!"></textarea>
                    </div>
                    <div class="row pb-3">
                        <div class="form-check form-switch ps-0">
                            <input type="checkbox" name="agenda" id="agenda" class="form-check-input mx-0">
                            <label for="agenda" class="form-check-label ms-3 radio-inline raleway-semibold">Add to Agenda</label>
                            <p class="mt-0 xsmall">
                                The Agenda will display a summary of your Quest. You can select up to three items per day. <br>
                                You can later modify the content displayed in the Agenda on the Edit page.
                            </p>
                        </div>
                    </div>
                    <div class="row pb-3 mx-0 justify-content-end">
                        <button type="submit" id="addon" class="btn btn-navy w-50"><i class="fa-solid fa-plus icon-xs d-inline"></i>Add on your quest</button>
                    </div>
                </div>
        </section>

        <section class="position-relative my-4 d-none" id="header">
            <img src="" alt="header-img" id="header-img" class="img-fluid w-100">
        
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
                <h3 class="my-0" id="header-title"></h3>
                <!-- 日付 -->
                <h4 class="my-0" id="header-dates"></h4>
                <!-- 紹介文 -->
                <p class="my-0" id="header-intro"></p>
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

        <section id="day-template" class="d-none spot-container">
            <div class="mx-2">
                <div class="row">
                    <p class="" id="day-number"></p>
                </div>
                <div class="row">
                    <h4 class="col-md-10 spot-name text-start poppins-bold py-3 px-0" id="spot-name">SPOT NAME</h4>
                    
                    <!-- 編集・削除ボタン -->
                    <div class="col-md-2 text-end">
                        <div class="justify-content-end">
                            <button class="btn btn-sm btn-green col-5 py-3"><a href="#form1" class="text-decoration-none text-white"><i class="fa-solid fa-pen-to-square"></i></a></button>
                            <button class="btn btn-sm btn-red col-5 py-3 ms-2" data-bs-toggle="modal" data-bs-target="#delete-post"><i class="fa-solid fa-trash"></i></button>
                        </div>
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
                    <div class="col-lg-6">
                        <img  src="{{asset('images/quest/pexels-pixabay-459203.jpg')}}" alt="" class="spot-image img-fluid image-thumbnail" id="spot-image">
                    </div>
                    <div class="col-lg-6 mt-4 mt-lg-0">
                        <p class="spot-description w-100" id="spot-description">Description Here------Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.Lorem ipsum dolor sit amet consectetur adipisicing elit. Commodi rem repellat blanditiis soluta assumenda rerum temporibus obcaecati ex! Laudantium animi, sunt impedit incidunt officia dolor, a dicta expedita numquam ad non odio maxime sit totam doloremque eos vero reiciendis eveniet laboriosam neque! Odit deleniti quam nobis ullam corrupti optio voluptates libero, labore hic sint debitis nisi iste repellat, beatae dolorem voluptas a, placeat enim repudiandae dicta minus aliquid dolore! Vitae reprehenderit libero nisi hic adipisci amet accusantium pariatur, error molestiae.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- dayセクションを追加する場所 -->
        <div id="day-container"></div>

            <button class="btn btn-navy w-100 mb-5 d-none" id="confirmBtn"><a href="" class="text-decoration-none text-white">Check</a></button>
    </div>
</body>
</html>

</div>
@vite(['resources/js/quest/add-quest.js'])
@endsection
