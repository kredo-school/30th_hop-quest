<div class="modal fade" id="save-confirmation-modal">
    <div class="modal-dialog">
        <div class="modal-content border-success">
            <div class="modal-header border-success">
                <h3 class="h4 text-success">
                    <i class="fa-regular fa-circle-check"></i> Confirm Save
                </h3>
            </div>
            <div class="modal-body">
                <p id="save-modal-text">Are you sure you want to save?</p>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">CANCEL</button>
                <button type="button" id="confirm-save-btn" class="btn btn-success">SAVE</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScriptで動的に表示を切り替え -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const businessTypeSelect = document.getElementById('business-type');
    const officialBadgeCheckbox = document.getElementById('official-certification-checkbox');
    const saveBtn = document.getElementById('save-btn');
    const saveModalText = document.getElementById('save-modal-text');

    saveBtn.addEventListener('click', function(event) {
        event.preventDefault();
        let text = "";

        if (businessTypeSelect.value == "1") {
            if (officialBadgeCheckbox.checked) {
                text = "Save Location with Applying HopQuest official certification badge";
            } else {
                text = "Save Location";
            }
        } else if (businessTypeSelect.value == "2") {
            if (officialBadgeCheckbox.checked) {
                text = "Save Event with Applying HopQuest official certification badge";
            } else {
                text = "Save Event";
            }
        } else {
            text = "Are you sure you want to save?";
        }

        document.getElementById('save-modal-text').textContent = text;
    });
});
</script>