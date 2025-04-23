@extends('layouts.app')

@section('title', 'Confirm_Spot')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/map.css')}}">
    <link rel="stylesheet" href="{{ asset('css/spot/addspot.css')}}">
@endsection

@section('content')
    <h2 class="container">Confirm Add Spot</h2>
    <div class="container justify-content-center align-items-center text-center">
        <div class="row row-cols-1 row-cols-md-4">
          <div class="col-12 col-md-4 add-spot-container">
            <form action="{{ route('storeSpot') }}" method="POST" class="add-spot-form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="confirmed" value="1">
                
                <div class="form-group">
                    <label for="title" class="form-label">Spot title</label>
                    <input type="text" id="title" name="title" class="form-input" value="{{ session('spot_confirmation.title') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="main_image" class="form-label">Main image</label>
                    @if(session('spot_confirmation.main_image'))
                        <div class="image-preview">
                            <img src="{{ asset(session('spot_confirmation.main_image.url')) }}" alt="メイン画像" class="preview-image">
                            <input type="hidden" name="main_image_path" value="{{ session('spot_confirmation.main_image.path') }}">
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="introduction" class="form-label">Spot introduction</label>
                    <textarea id="introduction" name="introduction" class="form-textarea" readonly>{{ session('spot_confirmation.introduction') }}</textarea>
                </div>

                @if(session('spot_confirmation.photos'))
                    <div class="form-group">
                        <label class="form-label">Additional photos</label>
                        <div class="additional-photos">
                            @foreach(session('spot_confirmation.photos') as $index => $photo)
                                <div class="photo-item">
                                    <img src="{{ asset($photo['url']) }}" alt="追加写真" class="preview-image-small">
                                    <input type="hidden" name="photos_paths[]" value="{{ $photo['path'] }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- @if(session('spot_confirmation.latitude') && session('spot_confirmation.longitude'))
                    <input type="hidden" name="latitude" value="{{ session('spot_confirmation.latitude') }}">
                    <input type="hidden" name="longitude" value="{{ session('spot_confirmation.longitude') }}">
                @endif -->

                <div class="button-group">
                    <button type="submit" class="btn btn-primary">登録する</button>
                    <button type="button" onclick="goBack()" class="btn btn-secondary">修正する</button>
                </div>
            </form>

            <script>
                function goBack() {
                    // フォームデータを保持したまま前のページに戻る
                    window.history.back();
                }
            </script>
          </div>
        </div>
    </div>

@endsection