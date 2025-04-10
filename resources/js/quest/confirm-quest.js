document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("toggle-visibility-form");
    const checkbox = document.getElementById("togglePrivate");
    const methodInput = document.getElementById("form-method");
    const submitBtn = document.getElementById("confirm-submit-btn");

    const questId = form.dataset.questId;
    const restoreUrl = window.questRoutes.restoreUrl;
    const softDeleteUrl = window.questRoutes.softDeleteUrl;
    console.log(restoreUrl);
    console.log(softDeleteUrl);

    // 初期状態でボタンテキスト更新（ページ読み込み時）
    updateButtonLabel();

    // チェック状態が変わったときにボタンのラベル変更
    checkbox.addEventListener("change", updateButtonLabel);

    // フォーム送信時の挙動切り替え
    form.addEventListener("submit", function (e) {
        e.preventDefault(); // JS制御するからデフォルト動作止める
    
        if (checkbox.checked) {
            methodInput.value = "DELETE";
            form.action = softDeleteUrl;
        } else {
            methodInput.value = "POST";
            form.action = restoreUrl;
        }
    
        form.submit(); // ← 送信だけでOK！リダイレクトはLaravelに任せる
    });

    function updateButtonLabel() {
        submitBtn.textContent = checkbox.checked ? "Save" : "Confirmed";
    }
});
