<!-- Spot作成モーダル -->
<div class="modal fade" id="addSpotModal-{{ $quest->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
      <div class="modal-content border border-quest-blue">
        <div class="modal-header">
          <h5 class="modal-title poppins-semibold fs-3">Add New Spot</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="modal-spot-create-form" enctype="multipart/form-data">
            @csrf
            <div class="row row-cols-1 row-cols-md-2">
              <!-- Left Side -->
              <div class="col">
                <div class="form-group mb-3">
                  <label for="modal-title" class="form-label">Spot Title</label>
                  <input type="text" class="form-control input-box" name="title" id="modal-title" required>
                </div>
                <div class="form-group mb-3">
                  <label for="modal-introduction" class="form-label">Introduction</label>
                  <textarea class="form-control text-area" name="introduction" id="modal-introduction" rows="4" required></textarea>
                </div>
                <div class="form-group mb-3">
                  <label for="modal-spot-images" class="form-label">Photos</label>
                  <input type="file" class="form-control input-box" name="spot-images[]" id="modal-spot-images" multiple>
                </div>
              </div>
  
              <!-- Right Side (Map) -->
              <div class="col">
                <label for="modal-address" class="form-label">Search Address</label>
                <div class="d-flex mb-2">
                  <input type="text" class="form-control me-2 input-box" id="modal-address" placeholder="Input address">
                  <button type="button" class="btn btn-outline-green" onclick="modalGeocodeAddress()">Search</button>
                </div>
                <div id="modal-map" style="height: 400px; width: 100%;"></div>
                <div id="modal-place-photo" class="mt-2"></div>
              </div>
            </div>
            <div class="text-end mt-4">
              <button type="submit" class="btn btn-navy">Save Spot</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
<script>
    window.questId = @json($quest->id);
</script>
 
@vite('resources/js/quest/quest-add-spot.js')

<script src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initModalMap" async defer></script>

