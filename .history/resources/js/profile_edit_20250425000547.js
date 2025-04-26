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
        console.log('ファイルが選択されました:', file);
        const url = URL.createObjectURL(file);
        const avatarPreview = document.getElementById('avatarPreview');
        if (avatarPreview) {
            avatarPreview.src = url;
            console.log('生成URL:', url);
            setTimeout(() => URL.revokeObjectURL(url), 100);
        } else {
            console.warn('avatarPreviewが見つかりません');
        }
    } else {
        console.warn('ファイルが選択されていません');
    }
});

document.querySelectorAll('#header, #avatar').forEach(input => {
  input.addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const preview = document.getElementById(
      this.id === 'header' ? 'headerPreview' : 'avatarPreview'
    );
    preview.src = URL.createObjectURL(file);
    setTimeout(() => URL.revokeObjectURL(preview.src), 100);
  });