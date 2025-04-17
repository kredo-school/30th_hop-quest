<div class="row">
    <div class="col mb-3">
        <h5 class="form-label">Facility Information</h5>
        <div class="accordion mb-4" id="detailsAccordion">
            @foreach($business_info_category as $category)
                <div class="accordion-item">
                    <div class="accordion-header" id="headingDetail{{ $loop->index }}">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#collapseDetail{{ $loop->index }}"
                                aria-expanded="false"
                                aria-controls="collapseDetail{{ $loop->index }}">
                            {{ $category->name }}
                        </button>
                    </div>
                    <div id="collapseDetail{{ $loop->index }}" class="accordion-collapse collapse"
                        aria-labelledby="headingDetail{{ $loop->index }}" data-bs-parent="#detailsAccordion">
                        <div class="accordion-body">
                            <div class="row">
                                @foreach($category->businessInfos as $info)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            @php
                                                $isChecked = false;
                                                $existingDetail = null;
                                                
                                                // edit.blade.phpでのみビジネス詳細を確認
                                                if (isset($business) && isset($business->businessDetails)) {
                                                    $existingDetail = $business->businessDetails->where('business_info_id', $info->id)->first();
                                                    if ($existingDetail && $existingDetail->is_valid == 1) {
                                                        $isChecked = true;
                                                    }
                                                }
                                            @endphp
                                            <input class="form-check-input"
                                                type="checkbox"
                                                id="info_{{ $info->id }}"
                                                name="business_info[]"
                                                value="{{ $info->id }}"
                                                {{ $isChecked ? 'checked' : '' }}>
                                            <label class="form-check-label"
                                                for="info_{{ $info->id }}">{{ $info->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>