<div class="row">
    <div class="accordion mb-4" id="detailsAccordion">
        @foreach($amenities as $category => $options)
            <div class="accordion-item">
                <div class="accordion-header" id="headingDetail{{ $loop->index }}">
                    <div class="row">
                        <div class="col-2">
                            <button class="accordion-button collapsed" type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#collapseDetail{{ $loop->index }}"
                                    aria-expanded="false"
                                    aria-controls="collapseDetail{{ $loop->index }}">
                                {{ $category }}
                            </button>
                        </div>
                    </div>
                </div>
                <div id="collapseDetail{{ $loop->index }}" class="accordion-collapse collapse"
                    aria-labelledby="headingDetail{{ $loop->index }}" data-bs-parent="#detailsAccordion">
                    <div class="accordion-body">
                        <div class="row">
                            @foreach($options as $option)
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input"
                                            type="checkbox"
                                            id="{{ Str::slug($option, '_') }}"
                                            name="details[{{ $category }}][]"
                                            value="{{ $option }}"
                                            @if(is_array(old("details.$category")) && in_array($option, old("details.$category")))
                                                checked
                                            @elseif(in_array($option, $checkedDetailItems))
                                                checked
                                            @endif>
                                        <label class="form-check-label"
                                            for="{{ Str::slug($option, '_') }}">{{ $option }}</label>
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