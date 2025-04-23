document.getElementById('header').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (!file) return;

    const reader = new FileReader();

    reader.onload = function(e) {
        const preview = document.getElementById('header-preview');
        const icon = document.getElementById('header-icon');

        preview.src = e.target.result;
        preview.style.display = 'block';
        if (icon) icon.style.display = 'none';
    }

    reader.readAsDataURL(file);
});


document.addEventListener("DOMContentLoaded", function () {
    const avatarInput = document.getElementById('avatar');
    const preview = document.getElementById('avatar-preview');
    const icon = document.getElementById('default-icon');
    const deleteBtn = document.getElementById('delete-avatar');

    // アップロード時にプレビュー表示
    avatarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
            if (icon) icon.style.display = 'none';
        };
        reader.readAsDataURL(file);
    });

    // 削除ボタンクリックで画像削除処理
    deleteBtn.addEventListener('click', function () {
        if (!confirm('画像を削除しますか？')) return;

        fetch("http://127.0.0.1:8000/profile/image", {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Accept": "application/json"
            }
        })
        .then(response => {
            if (response.ok) {
                preview.src = '';
                preview.style.display = 'none';
                if (icon) icon.style.display = 'block';
                alert('画像を削除しました');
            } else {
                alert('削除に失敗しました');
            }
        })
        .catch(() => {
            alert('エラーが発生しました');
        });
    });
});
