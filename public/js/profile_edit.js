// Header image preview
document.getElementById('header').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const url = URL.createObjectURL(file);
        document.getElementById('headerPreview').src = url;
        setTimeout(() => URL.revokeObjectURL(url), 100);
    }
});

// Avatar image preview
document.getElementById('avatar').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const url = URL.createObjectURL(file);
        document.getElementById('avatarPreview').src = url;
        setTimeout(() => URL.revokeObjectURL(url), 100);
    }
});