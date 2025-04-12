{{-- Business/Event photos --}}
<div class="mb-4 p-4 border rounded bg-light">
    <h4 class="form-label d-inline">Business/Event photos</h4>
    <div class="row">
        @for ($i = 1; $i <= 3; $i++)
        @php
            // 編集時には既存の写真を取得
            $existingPhoto = isset($business) && $business->photos 
                ? $business->photos->firstWhere('priority', $i) 
                : null;
        @endphp
        <div class="col-md-4 mb-3 text-center">
            <div class="position-relative">
                <div class="photo-preview" id="preview_{{ $i }}">
                    <label class="form-label d-block text-center">Photo {{ $i }}</label>
                    
                    {{-- 既存の画像がある場合は表示 --}}
                    @if($existingPhoto && $existingPhoto->image)
                        <img src="{{ $existingPhoto->image }}" alt="Photo {{ $i }}" class="img-thumbnail mb-2" style="max-height: 150px;">
                        <div class="mb-2">
                            <small class="text-muted">Current image</small>
                        </div>
                    @else
                        <div class="mb-2 text-center">
                            <i class="fa-solid fa-image text-secondary fa-3x mb-2"></i>
                            <div><small class="text-muted">No image uploaded</small></div>
                        </div>
                    @endif
                    
                    <input type="file"
                        id="photo_{{ $i }}"
                        name="photos[{{ $i }}]"
                        class="form-control photo-input @error('photos.' . $i) is-invalid @enderror"
                        accept="image/*">
                    <input type="hidden" name="priorities[{{ $i }}]" value="{{ $i }}">
                    <input type="hidden" name="existing_photos[{{ $i }}]" value="{{ $existingPhoto ? $existingPhoto->id : '' }}">
                    
                    @error('photos.'.$i)
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        @endfor
    </div>
</div>