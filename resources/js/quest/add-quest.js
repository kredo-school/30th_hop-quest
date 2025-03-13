document.getElementById("submit1").addEventListener("click", function() {
    console.log("Createボタンがクリックされました！");

    const startDate = document.getElementById("sdate").value;
    const endDate = document.getElementById("edate").value;

    if (!startDate || !endDate) {
        alert("日程を入力してください");
        return;
    }

    // 旅行期間を計算
    const start = new Date(startDate);
    const end = new Date(endDate);
    const days = (end - start) / (1000 * 60 * 60 * 24) + 1;

    // 日程選択を動的に作成
    const daySelect = document.getElementById("day_select");
    daySelect.innerHTML = "";
    for (let i = 1; i <= days; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.textContent = `DAY${i}`;
        daySelect.appendChild(option);
    }

    // フォーム2を表示
    document.getElementById("form2").classList.remove("d-none");
    console.log("form2 の d-none を削除しました！");
});

document.getElementById("addSpot").addEventListener("click", function() {
    const day = document.getElementById("day_select").value;
    const spot = document.getElementById("spot_select").selectedOptions[0].text;
    const description = document.getElementById("description").value;

    if (!spot || !description) {
        alert("スポットと説明を入力してください");
        return;
    }

    // 追加リストに表示
    const spotList = document.getElementById("spot_list");
    const listItem = document.createElement("li");
    listItem.textContent = `【${day}日目】${spot}: ${description}`;
    spotList.appendChild(listItem);

    // 入力をクリア
    document.getElementById("description").value = "";
});

document.getElementById("confirmBtn").addEventListener("click", function() {
    alert("確認画面へ移動！（実装はまだ）");
});
