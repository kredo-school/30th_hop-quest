<label class="form-label">Facility Details</label>
<div class="accordion mb-3" id="detailsAccordion">
    <!-- Accessibility Category -->
    <div class="accordion-item">
        <div class="accordion-header" id="headingAccessibility">
            <div class="row">
                <div class="col-2">
                    <button class="accordion-button" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseAccessibility" 
                            aria-expanded="true" 
                            aria-controls="collapseAccessibility">
                        Accessibility
                    </button>
                </div>
                <div class="col-auto ms-auto me-5 my-auto">
                    <!-- ここはチェックボックスがないので空のままにしておく -->
                </div>
            </div>
        </div>

        <div id="collapseAccessibility" class="accordion-collapse collapse show" 
             aria-labelledby="headingAccessibility" data-bs-parent="#detailsAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="wheelchair_accessible" 
                                   name="business_info[]" value="wheelchair_accessible"
                                   {{ isset($business) && $business->hasBusinessInfo('wheelchair_accessible') ? 'checked' : '' }}>
                            <label class="form-check-label" for="wheelchair_accessible">Wheelchair accessible</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="elevator_access" 
                                   name="business_info[]" value="elevator_access"
                                   {{ isset($business) && $business->hasBusinessInfo('elevator_access') ? 'checked' : '' }}>
                            <label class="form-check-label" for="elevator_access">Elevator access</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="accessible_parking" 
                                   name="business_info[]" value="accessible_parking"
                                   {{ isset($business) && $business->hasBusinessInfo('accessible_parking') ? 'checked' : '' }}>
                            <label class="form-check-label" for="accessible_parking">Accessible parking</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="accessible_restroom" 
                                   name="business_info[]" value="accessible_restroom"
                                   {{ isset($business) && $business->hasBusinessInfo('accessible_restroom') ? 'checked' : '' }}>
                            <label class="form-check-label" for="accessible_restroom">Accessible restroom</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="braille_signage" 
                                   name="business_info[]" value="braille_signage"
                                   {{ isset($business) && $business->hasBusinessInfo('braille_signage') ? 'checked' : '' }}>
                            <label class="form-check-label" for="braille_signage">Braille signage</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="hearing_loop" 
                                   name="business_info[]" value="hearing_loop"
                                   {{ isset($business) && $business->hasBusinessInfo('hearing_loop') ? 'checked' : '' }}>
                            <label class="form-check-label" for="hearing_loop">Hearing loop system</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Facilities Category -->
    <div class="accordion-item">
        <div class="accordion-header" id="headingFacilities">
            <div class="row">
                <div class="col-2">
                    <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseFacilities" 
                            aria-expanded="false" 
                            aria-controls="collapseFacilities">
                        Facilities
                    </button>
                </div>
                <div class="col-auto ms-auto me-5 my-auto">
                    <!-- ここはチェックボックスがないので空のままにしておく -->
                </div>
            </div>
        </div>

        <div id="collapseFacilities" class="accordion-collapse collapse" 
             aria-labelledby="headingFacilities" data-bs-parent="#detailsAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="free_wifi" 
                                   name="business_info[]" value="free_wifi"
                                   {{ isset($business) && $business->hasBusinessInfo('free_wifi') ? 'checked' : '' }}>
                            <label class="form-check-label" for="free_wifi">Free Wi-Fi</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="public_restroom" 
                                   name="business_info[]" value="public_restroom"
                                   {{ isset($business) && $business->hasBusinessInfo('public_restroom') ? 'checked' : '' }}>
                            <label class="form-check-label" for="public_restroom">Public restroom</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="parking_available" 
                                   name="business_info[]" value="parking_available"
                                   {{ isset($business) && $business->hasBusinessInfo('parking_available') ? 'checked' : '' }}>
                            <label class="form-check-label" for="parking_available">Parking available</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="bicycle_parking" 
                                   name="business_info[]" value="bicycle_parking"
                                   {{ isset($business) && $business->hasBusinessInfo('bicycle_parking') ? 'checked' : '' }}>
                            <label class="form-check-label" for="bicycle_parking">Bicycle parking</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="changing_room" 
                                   name="business_info[]" value="changing_room"
                                   {{ isset($business) && $business->hasBusinessInfo('changing_room') ? 'checked' : '' }}>
                            <label class="form-check-label" for="changing_room">Changing room</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="shower_facilities" 
                                   name="business_info[]" value="shower_facilities"
                                   {{ isset($business) && $business->hasBusinessInfo('shower_facilities') ? 'checked' : '' }}>
                            <label class="form-check-label" for="shower_facilities">Shower facilities</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Options Category -->
    <div class="accordion-item">
        <div class="accordion-header" id="headingPayment">
            <div class="row">
                <div class="col-2">
                    <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapsePayment" 
                            aria-expanded="false" 
                            aria-controls="collapsePayment">
                        Payment Options
                    </button>
                </div>
                <div class="col-auto ms-auto me-5 my-auto">
                    <!-- ここはチェックボックスがないので空のままにしておく -->
                </div>
            </div>
        </div>

        <div id="collapsePayment" class="accordion-collapse collapse" 
             aria-labelledby="headingPayment" data-bs-parent="#detailsAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="credit_cards" 
                                   name="business_info[]" value="credit_cards"
                                   {{ isset($business) && $business->hasBusinessInfo('credit_cards') ? 'checked' : '' }}>
                            <label class="form-check-label" for="credit_cards">Credit cards accepted</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="digital_payment" 
                                   name="business_info[]" value="digital_payment"
                                   {{ isset($business) && $business->hasBusinessInfo('digital_payment') ? 'checked' : '' }}>
                            <label class="form-check-label" for="digital_payment">Digital payment</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cash_only" 
                                   name="business_info[]" value="cash_only"
                                   {{ isset($business) && $business->hasBusinessInfo('cash_only') ? 'checked' : '' }}>
                            <label class="form-check-label" for="cash_only">Cash only</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="cash_accepted" 
                                   name="business_info[]" value="cash_accepted"
                                   {{ isset($business) && $business->hasBusinessInfo('cash_accepted') ? 'checked' : '' }}>
                            <label class="form-check-label" for="cash_accepted">Cash payment accepted</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="international_cards" 
                                   name="business_info[]" value="international_cards"
                                   {{ isset($business) && $business->hasBusinessInfo('international_cards') ? 'checked' : '' }}>
                            <label class="form-check-label" for="international_cards">International payment cards</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="contactless_payment" 
                                   name="business_info[]" value="contactless_payment"
                                   {{ isset($business) && $business->hasBusinessInfo('contactless_payment') ? 'checked' : '' }}>
                            <label class="form-check-label" for="contactless_payment">Contactless payment</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Smoking Policy Category -->
    <div class="accordion-item">
        <div class="accordion-header" id="headingSmoking">
            <div class="row">
                <div class="col-2">
                    <button class="accordion-button collapsed" type="button" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#collapseSmoking" 
                            aria-expanded="false" 
                            aria-controls="collapseSmoking">
                        Smoking Policy
                    </button>
                </div>
                <div class="col-auto ms-auto me-5 my-auto">
                    <!-- Keep this space due to no check-box here now -->
                </div>
            </div>
        </div>

        <div id="collapseSmoking" class="accordion-collapse collapse" 
             aria-labelledby="headingSmoking" data-bs-parent="#detailsAccordion">
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="non_smoking" 
                                   name="business_info[]" value="non_smoking"
                                   {{ isset($business) && $business->hasBusinessInfo('non_smoking') ? 'checked' : '' }}>
                            <label class="form-check-label" for="non_smoking">Completely non-smoking</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="smoking_area" 
                                   name="business_info[]" value="smoking_area"
                                   {{ isset($business) && $business->hasBusinessInfo('smoking_area') ? 'checked' : '' }}>
                            <label class="form-check-label" for="smoking_area">Smoking area available</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="smoking_rooms" 
                                   name="business_info[]" value="smoking_rooms"
                                   {{ isset($business) && $business->hasBusinessInfo('smoking_rooms') ? 'checked' : '' }}>
                            <label class="form-check-label" for="smoking_rooms">Designated smoking rooms</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="outdoor_smoking" 
                                   name="business_info[]" value="outdoor_smoking"
                                   {{ isset($business) && $business->hasBusinessInfo('outdoor_smoking') ? 'checked' : '' }}>
                            <label class="form-check-label" for="outdoor_smoking">Outdoor smoking section</label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="smoking_permitted" 
                                   name="business_info[]" value="smoking_permitted"
                                   {{ isset($business) && $business->hasBusinessInfo('smoking_permitted') ? 'checked' : '' }}>
                            <label class="form-check-label" for="smoking_permitted">Smoking permitted throughout</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>