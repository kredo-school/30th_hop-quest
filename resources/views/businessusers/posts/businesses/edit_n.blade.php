<div class="bg-blue">
    @extends('layouts.app')
    
    @section('title', 'Edit A Business - Location or Event')
    
    @section('content')
    <link rel="stylesheet" href="{{asset('css/style.css')}}"  /> 
        <main>
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8 box-border mx-auto" style="background-color: #B4D5F4; border-radius: 0px;">
    
                    <div class="d-flex mb-3">
                        <div class="col">
                            <h4 class=" d-inline me-3">Edit Business</h4>
                            <p class="form-label d-inline ">(<span class="color-red fw-bold">*</span> Required items)<p>
                        </div>
                        <button type="button" class="btn btn-red col-2 ms-auto" data-bs-toggle="modal" data-bs-target="#delete-category-modal">
                            DELETE
                        </button>
                    </div>
                    @include('businessusers.posts.businesses.modals.delete')
    
            <form action="{{ route('businesses.update', $business, Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                    
                <!-- Location or Event Details -->
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                    
                    <select class="form-control w-25" id="category_id" name="category_id">
                        <option value="1" {{ (old('category_id', $business->category_id) == 1) ? 'selected' : '' }}>Location</option>
                        <option value="2" {{ (old('category_id', $business->category_id) == 2) ? 'selected' : '' }}>Event</option>
                    </select>
                </div>
    
                <!-- Location or Event Details -->
                <div class="mb-3">
                    <!-- 現在の選択に基づいて初期表示 -->
                    <label for="name" class="form-label d-inline" id="name-label">
                        {{ (old('category_id', $business->category_id) == 2) ? 'Event' : 'Location' }} Name<span style="color: #D24848;">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name', $business->name ?? '') }}" class="form-control">
                </div>
    
                <!-- インラインスクリプトで確実に実行 -->
                <script>
                    // ページ読み込み完了時に実行
                    document.addEventListener("DOMContentLoaded", function() {
                        // 要素の取得
                        var categorySelect = document.getElementById("category_id");
                        var nameLabel = document.getElementById("name-label");
                        
                        // 要素が見つからない場合は処理を終了
                        if (!categorySelect || !nameLabel) return;
                        
                        // ラベル更新関数
                        function updateNameLabel() {
                            if (categorySelect.value == "1") {
                                nameLabel.innerHTML = "Location Name<span style='color: #D24848;'>*</span>";
                            } else if (categorySelect.value == "2") {
                                nameLabel.innerHTML = "Event Name<span style='color: #D24848;'>*</span>";
                            }
                        }
                        
                        // セレクト変更時にラベルを更新
                        categorySelect.addEventListener("change", updateNameLabel);
                        
                        // 初期表示時にも実行
                        updateNameLabel();
                    });
                </script>
                    
                   
                    <!-- Contact Information Form -->
                    @include('businessusers.posts.businesses.partials.contact-information')
    
                    {{-- main_image --}}
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="main_image" class="form-label">Upload Main Photo</label>
                            <img src="{{$business->main_image}}" alt="" class="d-block img-lg mb-2">
                            <input type="file" name="main_image" id="main_image" class="form-control form-control-sm w-100 mb-auto p-2" >
                        </div>                
                    </div>
                    
                    <!-- social-media -->
                    @include('businessusers.posts.businesses.partials.social-media')
    
                    <!-- Welcome message -->
                    <div class="mb-3">
                        <label for="introduction" class="form-label d-inline">
                            Welcome message<span style="color: #D24848;">*</span>
                        </label>
                        <textarea name="introduction" class="form-control">{{ old('introduction', $business->introduction ?? '') }}</textarea>
                    </div>
    
                    <!-- Business Location or Event Term Info and S.P.Notes -->
                    @include('businessusers.posts.businesses.partials.business-hours')
                        
                    <!-- Weekly Business Schedule' -->
                    @include('businessusers.posts.businesses.partials.weekly-schedule')
    
                    <!-- Facility information -->
                    @include('businessusers.posts.businesses.partials.business-details-facility', ['businessDetail' => $businessDetail ?? null, 'oldValues' => old('details')])
    
                    <!-- Identification Information -->
                    @include('businessusers.posts.businesses.partials.identification-information', ['business' => $business ?? null])

                    <!-- business-photos -->
                    @include('businessusers.posts.businesses.partials.business-photos')
    
                    <!-- Term for display to public this location/event -->
                    @include('businessusers.posts.businesses.partials.display-period', ['business' => $business ?? null])

                    <!-- Submission Buttons -->
                    @include('businessusers.posts.businesses.partials.submission-buttons', [
                        'business' => $business ?? null,
                        'submitButtonText' => isset($business) ? 'UPDATE' : 'SAVE'
                    ])
                </div>
            </form>
        </div>      
    </main>
    </div>
        @endsection