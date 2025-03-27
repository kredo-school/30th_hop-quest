@extends('layouts.app')
    
@section('title', 'Add A Business - Location or Event')
    
@section('content')
<div class="bg-blue">
    <div class="row justify-content-center pt-5">
        <form action="{{route('business.store')}}" method="post" enctype="multipart/form-data">
                @csrf
            
            <div class="col-md-10 col-lg-8 box-border mx-auto" >

                <div class="row mb-3">
                    <div class="col">
                        <h4 class=" d-inline me-3">Add A Business Location or Event</h4>
                        <p class="form-label d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                    </div>
                </div>

                <!-- プルダウンメニュー --> 
                <div class="row">
                    <div class="col mb-3">
                        <label for="category_id" class="form-label d-inline">
                            Choose one <span class="text-danger fw-bold">*</span>
                        </label>
                        <select class="form-control w-25" id="category_id" name="category_id">
                            <option value="" disabled selected>----------</option>
                            <option value="1">Location</option>
                            <option value="2">Event</option>
                        </select>
                    </div>
                </div>
                
                <!-- Location or Event Details -->
                <div class="row">
                    <div class="col mb-3">
                        <label for="name" class="form-label" id="name-label">Event Name<span style="color: #D24848;">*</span></label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                {{-- @push('scripts') --}}
                <!-- JavaScript -->
                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var select = document.getElementById("category_id"); 
                        var label = document.getElementById("name-label");

                        // 初期表示時にも選択されていれば変更
                        updateLabel();
                        
                        select.addEventListener("change", function() {
                            updateLabel();
                        });

                        function updateLabel() {
                            if (select.value == "1") {
                                label.innerHTML = "Location Name<span class='text-danger'>*</span>";
                            } else if (select.value == "2") {
                                label.innerHTML = "Event Name<span class='text-danger'>*</span>";
                            }
                        }
                    });
                </script>
                
                <div class="row">
                    <div class="col mb-3">
                        <label for="email" class="form-label">Email<span style="color: #D24848;">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" >
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col mb-3">
                        <label for="address_1" class="form-label">Address 1<span style="color: #D24848;">*</span></label>
                        <input type="text" name="address_1" id="address_1" class="form-control" >
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        <label for="address_2" class="form-label">Address 2</label>
                        <input type="text" name="address_2" id="address_2" class="form-control">
                    </div>
                </div> --}}

                {{-- images --}}
                <label for="image" class="form-label">Upload Photos</label>
                <div class="row">
                    <!-- Priority 1 -->
                    <div class="col-md-4">
                        <label for="image"></label>
                        <input type="file" name="image" id="image" class="form-control">
                    </div>
                
                </div>
                
            <!-- Submission Buttons -->
                <div class="row">
                    <div class="row mt-3 justify-content-center">
                        <div class="col-4 ">
                            <button type="submit" class="btn btn-green w-100 mb-2">SAVE</button>
                            {{-- <input type="checkbox" class="form-check-input mb-2" name="" id="" value=""> Apply for Official certification badge --}}
                        </div>
                        <div class="col-2"></div>
                        <div class="col-4 ">
                            <a href="{{route('profile.businesses', Auth::user()->id)}}">
                                <button class="btn btn-red w-100 ">CANCEL</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>       
    </div>
</div>
@endsection