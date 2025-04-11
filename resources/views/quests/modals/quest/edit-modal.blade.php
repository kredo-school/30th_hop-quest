<div class="modal fade edit-modal" id="edit-quest-{{ $quest->id }}"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content border-green border-4 p-3">
            <button type="button" class="btn-close position-absolute top-0 end-0" data-bs-dismiss="modal" aria-label="Close"></button>

            <div class="modal-header border-0">
                <h4 class="h2 poppins-bold"><i class="fa-solid fa-pen-to-square"></i> Edit Quest</h3>
            </div>
            <div class="modal-body">
                <form action="{{ route('quest.update', ['quest_id' => $quest->id]) }}" 
                    method="post" 
                    enctype="multipart/form-data" 
                    id="form1">
            
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="quest_id_hidden" id="quest_id_hidden" value="{{ request('quest_id') }}">
            
                    {{-- タイトル --}}
                    <div class="row pb-3">
                        <label for="title" class="form-label">Quest Title</label>
                        <input type="text" name="title" id="title" class="input-box" placeholder="Kyoto Trip"
                            value="{{ old('title', $quest->title ?? '') }}">
                        @error('title')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
            
                    {{-- ロールに応じた入力 --}}
                    @php
                        $role = Auth::user()->role_id;
                    @endphp
            
                    @if ($role == 1)
                        {{-- 日付入力 --}}
                        <div class="row pb-3">
                            <div class="col-5 px-0">
                                <label for="start_date" class="form-label">Start date</label>
                                <input type="date" name="start_date" id="start_date" class="input-box"
                                    value="{{ old('start_date', $quest->start_date ?? '') }}">
                                @error('start_date')
                                    <p class="mb-0 text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
            
                            <div class="col d-flex align-items-end justify-content-center">
                                <i class="fa-solid fa-caret-right icon-md"></i>
                            </div>
            
                            <div class="col-5 px-0">
                                <label for="end_date" class="form-label">End date</label>
                                <input type="date" name="end_date" id="end_date" class="input-box form-control"
                                    value="{{ old('end_date', $quest->end_date ?? '') }}">
                                @error('end_date')
                                    <p class="mb-0 text-danger small">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    @elseif ($role == 2)
                        {{-- 期間入力 --}}
                        <div class="row pb-3">
                            <label for="duration" class="form-label">Choose Quest duration</label>
                            <select id="duration" name="duration" class="w-25 p-2 border rounded mb-1">
                                @for ($i = 1; $i <= 10; $i++)
                                    <option value="{{ $i }}" {{ old('duration', $quest->duration ?? '') == $i ? 'selected' : '' }}>
                                        {{ $i }} Day{{ $i > 1 ? 's' : '' }}
                                    </option>
                                @endfor
                            </select>
                            @error('duration')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif
            
                    {{-- 紹介文 --}}
                    <div class="row pb-3">
                        <label for="introduction" class="form-label">Introduction</label>
                        <textarea name="introduction" id="introduction" class="text-area mx-0" cols="30" rows="5"
                                placeholder="My trip to Kyoto was...">{{ old('introduction', $quest->introduction ?? '') }}</textarea>
                        @error('introduction')
                            <p class="mb-0 text-danger small">{{ $message }}</p>
                        @enderror
                    </div>
                
                    {{-- メイン画像 --}}
                    <div class="row pb-3">
                        <label for="main_image" class="form-label">Header photo</label>
                        <div class="col-9 ps-0">
                            <input type="file" name="main_image" id="main_image" class="custom-file-input form-control">
                            @error('main_image')
                                <p class="mb-0 text-danger small">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-3 ms-auto pe-0">
                            <label for="main_image" class="btn btn-green custom-file-label w-100">
                                <i class="fa-solid fa-plus icon-xs d-inline"></i> Photo
                            </label>
                        </div>
                        <!-- データベースから取得したパスからファイル名を表示 -->
                        <div id="file-name" class="raleway-semibold fs-6 ps-1">
                            Current Photo:{{ basename($quest->main_image ?? '') }}
                        </div>
                        <p class="mt-0 ps-0 pb-0 xsmall">
                            Acceptable formats: jpeg, jpg, png, gif only.<br>Max size is 1048 KB
                        </p>   
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-md btn-outline-green" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit1" id="update" class="btn btn-md btn-green">Update</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>




