let selectedFiles = [];

document.getElementById('images').addEventListener('change', function(e) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = ''; // プレビューを初期化

    // 新しく選択されたファイルを既存の配列に追加
    selectedFiles = selectedFiles.concat([...e.target.files]);

    // 最大6枚までに制限
    if (selectedFiles.length > 6) {
        alert('画像は最大6枚までアップロードできます');
        selectedFiles = selectedFiles.slice(0, 6);
    }

    // プレビューを表示
    selectedFiles.forEach((file, index) => {
        const div = document.createElement('div');
        div.classList.add('mb-1');

        div.innerHTML = `
            ${file.name} 
            <button type="button" class="btn btn-sm btn-danger" onclick="removeFile(${index})">×</button>
        `;

        preview.appendChild(div);
    });

    // フォームのファイル入力を更新
    updateFormFiles();
});

function removeFile(index) {
    // 指定されたインデックスのファイルを削除
    selectedFiles = selectedFiles.filter((_, i) => i !== index);

    // プレビューを更新するためにchangeイベントを発火
    const event = new Event('change');
    document.getElementById('images').dispatchEvent(event);
}

function updateFormFiles() {
    const dt = new DataTransfer();
    selectedFiles.forEach(file => dt.items.add(file));

    const input = document.getElementById('images');
    input.files = dt.files;
}