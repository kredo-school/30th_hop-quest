//page refredh
window.addEventListener("beforeunload", function() {
    localStorage.clear();
});
window.addEventListener("load", function () {
    let url = new URL(window.location);

    // 🔥 `saved` フラグがない場合のみ `quest_id` を削除
    if (!window.history.state || !window.history.state.saved) {
        if (url.searchParams.has("quest_id")) {
            url.searchParams.delete("quest_id"); // `quest_id` を削除
            window.history.replaceState({}, "", url); // URL を更新（リロードなし）
            console.log("🔥 quest_id をクリアしました！");
        }
    }
});

// load==========================================================

// **アップロードした画像を保存するリスト**
let uploadedImagesList = []; 

// 📌 アップロードしたファイル名と削除ボタンを `uploaded-file-names` に表示
// **画像リストを更新してサムネイルを表示**
function updateUploadedFileNames() {
    const uploadedFileNames = document.getElementById("uploaded-file-names");
    uploadedFileNames.innerHTML = ""; // 一旦クリアして再表示

    console.log("🖼 画像リスト:", uploadedImagesList); // 🔥 デバッグ用

    uploadedImagesList.forEach((file, index) => {
        const fileItem = document.createElement("div");
        fileItem.classList.add("uploaded-file-item", "d-flex", "align-items-center", "justify-content-between");

        // **🖼 サムネイル画像を追加**
        const reader = new FileReader();
        reader.onload = function (e) {
            const thumbnail = document.createElement("img");
            thumbnail.classList.add("photo-thumbnail", "me-2"); // スタイル用のクラスを追加
            thumbnail.src = e.target.result; // ✅ FileReader の結果を使う
            thumbnail.alt = `Uploaded Image ${index + 1}`;
            thumbnail.style.width = "6.25rem"; // サムネイルのサイズ指定
            thumbnail.style.objectFit = "cover"; // 画像を枠内に収める

            fileItem.insertBefore(thumbnail, fileItem.firstChild); // 🔥 ここで追加する
        };
        reader.readAsDataURL(file); // ✅ ファイルを読み込む（Base64にはしない）

        // **❌ 削除ボタン**
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("btn", "btn-sm", "btn-red", "ms-2");
        deleteButton.innerHTML = "<i class='fa-solid fa-trash'></i>";
        deleteButton.addEventListener("click", function () {
            removeImage(index);
        });

        fileItem.appendChild(deleteButton);
        uploadedFileNames.appendChild(fileItem);
    });
}


    // **画像を削除する関数**
    function removeImage(index) {
        uploadedImagesList.splice(index, 1); // 配列から削除
        updateUploadedFileNames(); // リストを更新
    }

    // フォーム2が表示されたときだけリスナーを適用
    function initializeForm2Listeners() {
        const fileInput = document.getElementById("image");
    const uploadBtn = document.getElementById("upload-btn");
    const uploadedFileNames = document.getElementById("uploaded-file-names");

    if (!fileInput || !uploadBtn || !uploadedFileNames) {
        console.error("📌 フォーム2の要素が見つかりません。");
        return;
    }

    // **「追加」ボタンを無効化**
    uploadBtn.disabled = true;

    // **ファイルが選択されたら「追加」ボタンを有効化**
    fileInput.addEventListener("change", function () {
        uploadBtn.disabled = fileInput.files.length === 0;
    });

    // **「追加」ボタンが押されたときの処理**
    uploadBtn.addEventListener("click", function (event) {
    event.preventDefault(); // デフォルトのボタン動作を防ぐ

    if (fileInput.files.length === 0) {
        alert("ファイルを選択してください");
        return;
    }

    // **選択されたファイルを `uploadedImagesList` に追加（Base64 変換しない）**
    Array.from(fileInput.files).forEach(file => {
        uploadedImagesList.push(file); // 🔥 そのまま `File` オブジェクトを保存
        updateUploadedFileNames(); // **ファイルリストを更新**
    });

    // **ファイルインプットをクリア**
    fileInput.value = "";
    uploadBtn.disabled = true;
    });


        console.log("✅ フォーム2のリスナーを適用しました！");
    }

    // `form2` が表示されたらリスナーを適用
    document.getElementById("submit1").addEventListener("click", function () {
        alert('clicked');
        setTimeout(() => {
            if (!form2.classList.contains("d-none")) {
                initializeForm2Listeners();
            }
        }, 300); // `d-none` 削除後に適用
    });


    let isDataChanged = false;

    // **入力が変更されたら `isDataChanged` を `true` にする**
    document.querySelectorAll("input, textarea, select").forEach((element) => {
        element.addEventListener("change", () => {
            isDataChanged = true;
        });
    });

    window.addEventListener("beforeunload", function (event) {
        if (isDataChanged) {
            event.preventDefault();
            event.returnValue = "";
        }
    });
    // ページ読み込み時に `localStorage` のデータをセットする
    if (localStorage.getItem("questData")) {
        const savedData = JSON.parse(localStorage.getItem("questData"));

        document.getElementById("title").value = savedData.title;
        document.getElementById("start_date").value = savedData.startDate;
        document.getElementById("end_date").value = savedData.endDate;
        document.getElementById("intro").value = savedData.intro;

        document.getElementById("header-title").textContent = savedData.title;
        document.getElementById("header-dates").textContent = `${savedData.startDate} - ${savedData.endDate}`;
        document.getElementById("header-intro").textContent = savedData.intro;
    }

    // **画像を復元**
    if (localStorage.getItem("headerImage")) {
        document.getElementById("header-img").src = localStorage.getItem("headerImage");
    }


// ======================================FORM1=============================================================d
document.getElementById("submit1").addEventListener("click", async function(event) {
    event.preventDefault(); // フォーム送信を防ぐ

    console.log("Createボタンがクリックされました！");

    // 入力値を取得
    const title = document.getElementById("title").value;
    const startDate = document.getElementById("start_date").value;
    const endDate = document.getElementById("end_date").value;
    const intro = document.getElementById("introduction").value;
    const fileInput = document.getElementById("main_image");

    console.log("fileInput:", fileInput);

    // 必須チェック
    if (!title || !startDate || !endDate || !intro || !fileInput.files.length) {
        alert("すべての項目を入力してください");
        return;
    }

    //countthe duration
    const start = new Date(startDate);
    const end = new Date(endDate);

    // エラーチェック：開始日が終了日より未来だったらエラーを出す
    if (start > end) {
        alert("終了日は開始日より後の日付を選んでください");
        return;
    }

    // `localStorage` にデータを保存
    const questData = {
        title: title,
        startDate: startDate,
        endDate: endDate,
        intro: intro
    };
    localStorage.setItem("questData", JSON.stringify(questData));

    const days = Math.round((end - start) / (1000 * 60 * 60 * 24)) + 1;
    console.log(`選択された日数: ${days} 日`);

    // make options for day_select
    const daySelect = document.getElementById("day_number");
    if(daySelect){
        daySelect.innerHTML = "";
        for (let i = 1; i <= days; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.textContent = `DAY${i}`;
        daySelect.appendChild(option);
        console.log("day_selectはOK");
        }
        console.log("day_select_option作成完了");
    }else{
        console.error("day_numberが見つかりません");
    }

    // **ヘッダーに反映**
    document.getElementById("header-title").textContent = title;
    document.getElementById("header-dates").textContent = startDate + "〜" + endDate;
    document.getElementById("header-intro").textContent = intro;

    console.log("ヘッダーにデータを反映しました！");

    // **画像の処理**
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const headerImg =document.getElementById("header-img");

            if(headerImg){
                headerImg.src = e.target.result;
                // **画像も `localStorage` に保存**
                try{
                    sessionStorage.setItem("headerImage", e.target.result);
                }catch(error){
                    console.error("画像データの保存に失敗しました！", error);
                }
            }else{
                console.error("エラー：header-imgが見つかりません！");
            }
        };

        reader.readAsDataURL(file);
    }
        
// `form2` も表示
    document.getElementById("form2").classList.remove("d-none");
    document.getElementById("header").classList.remove("d-none");
    console.log("form2 の d-none を削除しました！");

// フォーム送信処理
let form = document.getElementById('form1'); 
let formData = new FormData(form);
console.log(formData);

try {
    let response = await fetch('/quest/add-quest/store', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    });

    let result = await response.json(); // 🔥 JSONレスポンスを取得
    if (response.ok) {
        document.getElementById('responseMessage').innerHTML = "<p style='color: green;'>Success! Data saved.</p>";

        if (result.quest_id) {
            let newUrl = new URL(window.location);
            newUrl.searchParams.set('quest_id', result.quest_id);
            window.history.pushState({ saved: true }, '', newUrl); // 🔥 `saved: true` を状態として保存
            console.log("✅ URL 更新:", newUrl.toString());

            // 🔥 クエストデータを取得してフォームにセット
            fetchQuestData(result.quest_id);
        }
    } else {
        let errors = Object.values(result).map(error => `<p style='color: red;'>${error}</p>`).join("");
        document.getElementById('responseMessage').innerHTML = errors;
    }
} catch (error) {
    console.error('Error:', error);
}


// 🔥 quest_id を使ってデータを取得する関数
async function fetchQuestData(questId) {
    console.log("🔥 questId を取得:", questId); // 🔥 デバッグ用
    try {
        let response = await fetch(`/quest/get/${questId}`); // Laravel のエンドポイント
        let data = await response.json();

        console.log(data);
        // フォームにセット
        document.getElementById("title").value = data.title;
        document.getElementById("start_date").value = data.start_date;
        document.getElementById("end_date").value = data.end_date;
        document.getElementById("introduction").value = data.introduction;
        document.getElementById("quest_id_input").value = questId;
        document.getElementById("quest_id_hidden").value = questId;

        // 🔥 `base64` 画像データを `hidden` input に格納
        if (data.image_url) {
            document.getElementById("hidden_image_data").value = data.image_url;
            // 同時に data オブジェクトにもセット
            data.image_url = data.image_url;
        }
        // console.log("✅ URL 更新:", newUrl.toString());
        document.getElementById("submit1").classList.add("d-none");
        document.getElementById("update").classList.remove("d-none");
    
        console.log("データ取得完了！", data);
    } catch (error) {
        console.error("データ取得エラー:", error);
    }
}

});
document.getElementById("update").addEventListener("click", async function(event) {
    event.preventDefault(); // フォーム送信を防ぐ

    console.log("Updateボタンがクリックされました！");

    // 入力値を取得
    const title = document.getElementById("title").value;
    const startDate = document.getElementById("start_date").value;
    const endDate = document.getElementById("end_date").value;
    const intro = document.getElementById("introduction").value;
    const fileInput = document.getElementById("main_image");

    console.log("fileInput:", fileInput);

    // 必須チェック
    if (!title || !startDate || !endDate || !intro || !fileInput.files.length) {
        alert("すべての項目を入力してください");
        return;
    }

    //countthe duration
    const start = new Date(startDate);
    const end = new Date(endDate);

    // エラーチェック：開始日が終了日より未来だったらエラーを出す
    if (start > end) {
        alert("終了日は開始日より後の日付を選んでください");
        return;
    }

    // `localStorage` にデータを保存
    const questData = {
        title: title,
        startDate: startDate,
        endDate: endDate,
        intro: intro
    };
    localStorage.setItem("questData", JSON.stringify(questData));

    const days = Math.round((end - start) / (1000 * 60 * 60 * 24)) + 1;
    console.log(`選択された日数: ${days} 日`);

    // make options for day_select
    const daySelect = document.getElementById("day_number");
    if(daySelect){
        daySelect.innerHTML = "";
        for (let i = 1; i <= days; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.textContent = `DAY${i}`;
        daySelect.appendChild(option);
        console.log("day_selectはOK");
        }
        console.log("day_select_option作成完了");
    }else{
        console.error("day_numberが見つかりません");
    }

    // **ヘッダーに反映**
    document.getElementById("header-title").textContent = title;
    document.getElementById("header-dates").textContent = startDate + "〜" + endDate;
    document.getElementById("header-intro").textContent = intro;

    console.log("ヘッダーにデータを反映しました！");

    // **画像の処理**
    if (fileInput.files.length > 0) {
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const headerImg =document.getElementById("header-img");

            if(headerImg){
                headerImg.src = e.target.result;
                // **画像も `localStorage` に保存**
                try{
                    sessionStorage.setItem("headerImage", e.target.result);
                }catch(error){
                    console.error("画像データの保存に失敗しました！", error);
                }
            }else{
                console.error("エラー：header-imgが見つかりません！");
            }
        };

        reader.readAsDataURL(file);
    }
        
// `form2` も表示
    document.getElementById("form2").classList.remove("d-none");
    document.getElementById("header").classList.remove("d-none");
    console.log("form2 の d-none を削除しました！");

// フォーム送信処理
    // CSRFトークンをリフレッシュ
    async function refreshCsrfToken() {
        let response = await fetch('/refresh-csrf-token'); // 新しいトークンを取得するエンドポイント
        let data = await response.json();

        // 取得したトークンをmetaタグにセット
        let csrfMetaTag = document.querySelector('meta[name="csrf-token"]');
        csrfMetaTag.setAttribute('content', data.csrf_token);

        // 以降のAJAXリクエストに新しいトークンを自動で付与できるように設定
        document.querySelector('meta[name="csrf-token"]').content = data.csrf_token;
        
        console.log('CSRFトークンがリフレッシュされました');
    }

    // ページがロードされたときにCSRFトークンをリフレッシュ
    refreshCsrfToken();
    let form = document.getElementById('form1'); 
    let formData = new FormData(form);
    
        console.log(formData);
        let hiddenImageData = document.getElementById("hidden_image_data").value;
    
        if (fileInput.files.length === 0 && hiddenImageData) {
            // ユーザーが新しい画像を選択していない場合は、hiddenのbase64を送信
            formData.append("main_image", hiddenImageData);
        }

try {
    let response = await fetch('/quest/update/{quest_id}' ,{
        method: 'PUT',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    });

    let result = await response.json(); // 🔥 JSONレスポンスを取得
    if (response.ok) {
        document.getElementById('responseMessage').innerHTML = "<p style='color: green;'>Success! Data saved.</p>";

        if (result.quest_id) {
            let newUrl = new URL(window.location);
            newUrl.searchParams.set('quest_id', result.quest_id);
            window.history.pushState({ saved: true }, '', newUrl); // 🔥 `saved: true` を状態として保存
            console.log("✅ URL 更新:", newUrl.toString());

            // 🔥 クエストデータを取得してフォームにセット
            fetchQuestData(result.quest_id);
        }
    } else {
        let errors = Object.values(result).map(error => `<p style='color: red;'>${error}</p>`).join("");
        document.getElementById('responseMessage').innerHTML = errors;
    }
} catch (error) {
    console.error('Error:', error);
}


// 🔥 quest_id を使ってデータを取得する関数
async function fetchQuestData(questId) {
    console.log("🔥 questId を取得:", questId); // 🔥 デバッグ用
    try {
        let response = await fetch(`/quest/get/${questId}`); // Laravel のエンドポイント
        let data = await response.json();

        // フォームにセット
        document.getElementById("title").value = data.title;
        document.getElementById("start_date").value = data.start_date;
        document.getElementById("end_date").value = data.end_date;
        document.getElementById("introduction").value = data.introduction;
        document.getElementById("quest_id_input").value = questId;
        // console.log("✅ URL 更新:", newUrl.toString());
        // **🔥 ボタンのテキストを変更**
        let submitButton = document.getElementById("submit1");
        if (submitButton) {
            submitButton.textContent = "Update"; // ✅ 更新ボタンに変更
        }
        console.log("データ取得完了！", data);
    } catch (error) {
        console.error("データ取得エラー:", error);
    }
}

});


// ======================================FORM2=============================================================d
let spotList = JSON.parse(localStorage.getItem("spotList")) || []; // 保存済みのデータを取得
// ====================search=================
document.addEventListener("DOMContentLoaded", function () {
    let searchInput = document.getElementById("spot_name"); // 入力ボックス
    let searchResults = document.getElementById("searchResults"); // 結果を表示する div

    searchInput.addEventListener("input", function () {
        let query = this.value.trim(); // 入力された値（空白削除）
    
        if (query.length < 2) { // 2文字未満なら結果をクリア
            searchResults.innerHTML = "";
            return;
        }
        warning.classList.remove("d-none"); // 🔥 選択肢が表示されている間は警告を表示

    
        fetch(`/quest/search/Ajax?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                searchResults.innerHTML = ""; // 検索結果をクリア
    
                if (data.length > 0) {
                    let resultList = document.createElement("ul");
                    resultList.classList.add("list-group");
    
                    data.forEach(item => {
                        let listItem = document.createElement("li");
                        listItem.classList.add("list-group-item");
                        console.log("📌 検索結果のデータ構造:", item);

                        // Spot の場合は title、Business の場合は name を表示
                        let displayText = item.title ? item.title : item.name;
                        listItem.textContent = displayText;
    
                        // 🔥 選択肢ごとに type をデータ属性にセット
                        listItem.dataset.type = item.type; // "spot" または "business"
                        listItem.dataset.id = item.id;
               
                        listItem.addEventListener("click", function () {
                            searchInput.value = displayText; // クリックで入力欄にセット
                            warning.classList.add("d-none"); // 選択肢がない場合は警告を非表示
                            searchResults.innerHTML = ""; // 検索結果をクリア
                            console.log("🔥 選択されたタイプ:", this.dataset.type);
                            console.log("🔥 選択されたID:", this.dataset.id);

                            // 🔥 hidden input に type と id をセット
                            document.getElementById("spot_business_type").value = this.dataset.type;
                            document.getElementById("spot_business_id").value = this.dataset.id;
                        });
    
                        resultList.appendChild(listItem);
                    });
                    searchResults.appendChild(resultList);
                    warning.classList.remove("d-none"); // 🔥 選択肢が表示されている間は警告を表示
                } else {
                    searchResults.innerHTML = "<p class='text-muted'>No results found. Please Add Spot from the button on the right.</p>";
                     // 🔥 フォーム送信前にチェック（自由入力がある場合は無効にする）

                }
            })
            .catch(error => console.error("Error fetching search results:", error));
    });
    
});

document.getElementById("addon").addEventListener("click", async function(event) {
    event.preventDefault();
    console.log("🛠 ADD SPOT ボタンが押されました");

    // 入力値の取得
    const day = parseInt(document.getElementById("day_number").value, 10) || 1;
    const spot = document.getElementById("spot_name").value;
    const description = document.getElementById("spot_description").value;
    const fileInput2 = uploadedImagesList;
    const isAgendaChecked = document.getElementById("agenda").checked;

    if (!spot || !description) {
        alert("スポットと説明を入力してください");
        return;
    }

    let imageSrcList = [];  // 画像の配列
    console.log(imageSrcList);
    console.log(fileInput2);

    imageSrcList = fileInput2;
    console.log("画像が処理された！");

    //save spot
    saveSpotData(day, spot, description, imageSrcList, isAgendaChecked);
    
    document.getElementById("confirmBtn").classList.remove("d-none");
    console.log("Confirm button の d-none を削除しました！");

//redirectせずにformを送信
// `fetch` で送信する処理
    let form2 = document.getElementById("body_form");
    let formData2 = new FormData(form2);

    console.log("🔥 form2:", form2);
    if (!form2) {
        console.error("❌ エラー: form2 が見つかりません！");
        return;
    }
    // ✅ `uploadedImagesList` を `FormData2` に追加する処理
    uploadedImagesList.forEach((file, index) => {
        if (file instanceof File) {  // 🔥 `File` オブジェクトか確認
            formData2.append("images[]", file); // `images[]` 配列として追加
            console.log(`✅ 画像 ${index + 1} を FormData2 に追加:`, file.name);
        } else {
            console.error(`🛑 画像 ${index + 1} は File オブジェクトではありません！`, file);
        }
    });

    // ✅ `FormData2` の中身を確認
    for (let pair of formData2.entries()) {
        console.log(`🔥 ${pair[0]}:`, pair[1]);
    }

        console.log("🔥 formData2 を取得:", formData2); 
        // 🚀 fetch で送信
        let response = await fetch("/quest/add-quest/bodystore", {
            method: "POST",
            body: formData2,
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
            }
        });

            // **🔥 `localStorage` を削除（少し遅らせる）**
            setTimeout(() => {
                localStorage.removeItem("spotList"); // `spotList` だけ削除
                console.log("🗑️ `spotList` を削除しました");
            }, 500); // 0.5秒後に削除
            clearForm2(); // 入力をクリア
        });

function saveSpotData(day, spot, description, imageSrcList, isAgendaChecked) {
    const newSpot = {
        day,
        spot,
        description,
        images: imageSrcList,
        agenda: isAgendaChecked // ✅ ここで `agenda` の値を保存
    };

    console.log("💾 保存するスポット:", newSpot);

    spotList.push(newSpot);
    localStorage.setItem("spotList", JSON.stringify(spotList)); // `localStorage` に保存

    displayAllSpots(); // 画面を更新
}

function displayAllSpots() {
    const dayContainer = document.getElementById("day-container");

    console.log("🛠 displayAllSpots 実行！");

    // **🔥 既存の内容をリセット**
    dayContainer.innerHTML = "";

    // `spotList` を `day` の順番でソート
    spotList.sort((a, b) => a.day - b.day);

    spotList.forEach(spotData => {
        addSpotToContainer(spotData);
    });

    // **🔥 すべてのスポットが描画された後に高さを調整**
    setTimeout(() => {
        console.log("✅ displayAllSpots: 高さ調整を実行");
        adjustDescriptionHeight();
    }, 500); // 0.5秒遅らせる
}

    function addSpotToContainer(spotData) {
        const dayContainer = document.getElementById("day-container");
    
        // `day-group` を探す
        let dayElement = document.querySelector(`.day-group[data-day='${spotData.day}']`);
    
        // `day-group` がなければ新しく作成
        if (!dayElement) {
            dayElement = document.createElement("div");
            dayElement.classList.add("bg-white", "rounded-3", "p-3", "my-5", "day-group");
            dayElement.setAttribute("data-day", spotData.day);
            dayElement.classList.add(getBorderColorClass(spotData.day));
    
            const dayTitle = document.createElement("p");
            dayTitle.classList.add("day-number", "p-4", getColorClass(spotData.day), "text-center", "fs-3");
            dayTitle.textContent = `DAY ${spotData.day}`;
            dayElement.appendChild(dayTitle);
    
            dayContainer.appendChild(dayElement);
        }
    
        // すでにスポットがあるなら区切り線を追加
        if (dayElement.children.length > 1) {
            const hr = document.createElement("hr");
            hr.classList.add("my-3"); // スペースを確保
            dayElement.appendChild(hr);
        }
    
        // スポットを追加
        const spotElement = createSpotElement(spotData);
        dayElement.appendChild(spotElement);
    
        console.log("✅ スポットを追加:", spotData);

        // **🔥 高さ調整を少し遅らせて実行**
        // console.log("高さ調整：addSpotContainer");
        // setTimeout(adjustDescriptionHeight, 500);
    }

    function createSpotElement(spotData) {
        const newSpot = document.createElement("div");
        newSpot.classList.add("spot-entry");
    
        // **スポットタイトルと編集・削除ボタン**
        const spotHeader = document.createElement("div");
        spotHeader.classList.add("row", "pb-3", "justify-content-between", "align-items-center");
    
        const spotTitle = document.createElement("h4");
        spotTitle.classList.add("spot-name", "poppins-bold", "col-md-10", "text-start");
        spotTitle.id = "spot-name"; // IDを設定
        spotTitle.textContent = spotData.spot;
    
        const buttonContainer = document.createElement("div");
        buttonContainer.classList.add("col", "ms-0", "text-end", "pe-0");
    
        buttonContainer.innerHTML = `
            <button class="btn btn-sm btn-green"><a href="#form1" class="text-decoration-none text-white"><i class="fa-solid fa-pen-to-square"></i></a></button>
            <button class="btn btn-sm btn-red" data-bs-toggle="modal" data-bs-target="#delete-post"><i class="fa-solid fa-trash"></i></button>
        `;
    
        // **Agenda チェックボックス**
        const agendaCheckbox = document.createElement("input");
        agendaCheckbox.type = "checkbox";
        agendaCheckbox.classList.add("form-check-input");
        agendaCheckbox.id = "agenda"; // IDを設定
        agendaCheckbox.checked = spotData.agenda; // ✅ ここでチェック状態をセット
        agendaCheckbox.addEventListener("change", function () {
            spotData.agenda = agendaCheckbox.checked;
            console.log("📝 アジェンダ変更:", spotData.agenda);
        });
    
        const agendaLabel = document.createElement("label");
        agendaLabel.appendChild(agendaCheckbox);
        agendaLabel.append(" Agenda ");
    
        const agendaRow = document.createElement("div");
        agendaRow.classList.add("row", "mt-2");
        agendaRow.appendChild(agendaLabel);
    
        buttonContainer.appendChild(agendaRow);
    
        spotHeader.appendChild(spotTitle);
        spotHeader.appendChild(buttonContainer);
    
        // **画像表示エリア**
        const imgContainer = document.createElement("div");
        imgContainer.classList.add("col-lg-6", "image-container", "d-block", "flex-column");
    
        console.log("🖼 画像リスト:", spotData.images); // 🔥 デバッグ用
    
        if (spotData.images && spotData.images.length > 0) {
            spotData.images.forEach((img) => {
                const spotImg = document.createElement("img");
                spotImg.classList.add("image", "img-fluid", "mb-2");
    
                // 🔥 画像データが Base64 か File かチェック
                if (typeof img === "string") {
                    spotImg.src = img; // Base64 画像ならそのままセット
                } else if (img instanceof File) {
                    spotImg.src = URL.createObjectURL(img); // File オブジェクトならURLを生成
                } else {
                    console.error("❌ 不明な画像データ:", img);
                }
    
                console.log("✅ 画像の `src`:", spotImg.src); // 🔥 デバッグ用
                imgContainer.appendChild(spotImg);
            });
        } else {
            console.warn("⚠️ 画像がありません！");
        }
    
        // **🔥 高さ調整を少し遅らせて実行**
        console.log("高さ調整：createSpotElement");
        setTimeout(adjustDescriptionHeight, 500);
    
        // **説明文**
        const descContainer = document.createElement("div");
        descContainer.classList.add("col-lg-6", "mt-4", "mt-lg-0", "spot-description-container");
    
        const spotDesc = document.createElement("p");
        spotDesc.classList.add("spot-description", "w-100");
        spotDesc.textContent = spotData.description;
    
        descContainer.appendChild(spotDesc);
    
        // **スポットのコンテンツ**
        const spotContent = document.createElement("div");
        spotContent.classList.add("row");
        spotContent.appendChild(imgContainer);
        spotContent.appendChild(descContainer);
    
        newSpot.appendChild(spotHeader);
        newSpot.appendChild(spotContent);
    
        return newSpot;
    }
    
    

    function getBorderColorClass(day) {
        const borderColors = ["border-quest-red", "border-quest-navy", "border-quest-green", "border-quest-blue"];
        return borderColors[(day - 1) % borderColors.length]; // DAYの値でループ
    }

    function getColorClass(day) {
        const textColors = ["color-red", "color-navy", "color-green", "color-blue"];
        return textColors[(day - 1) % textColors.length]; // DAYの値でループ
    }


    function clearForm2() {
        console.log("🧹 フォーム2をクリアします！");
        document.getElementById("spot_name").value = "";
        document.getElementById("spot_description").value = "";
        document.getElementById("image").value = "";

        // **アップロード画像リストをクリア**
        uploadedImagesList = [];
        document.getElementById("uploaded-file-names").innerHTML = ""; // 表示もクリア
        
    }

// **Confirm ボタンの処理**
document.getElementById("confirmBtn").addEventListener("click", function () {
    alert("確認画面へ移動！（実装はまだ）");
    localStorage.clear();
    console.log("✅ localStorage をクリアしました！");
});


function adjustDescriptionHeight() {
    console.log("🎯 adjustDescriptionHeight: 実行開始！");

    let spotEntries = document.querySelectorAll(".spot-entry"); // 各スポットを取得

    if (spotEntries.length === 0) {
        console.warn("⚠️ adjustDescriptionHeight: スポットが見つかりません");
        return;
    }

    spotEntries.forEach((spot, index) => {
        let imageContainer = spot.querySelector(".image-container");
        let description = spot.querySelector(".spot-description");

        if (!imageContainer || !description) {
            console.warn(`⚠️ Spot ${index + 1}: 画像コンテナまたは説明が見つかりません`);
            return;
        }

        let images = imageContainer.querySelectorAll("img");

        if (images.length === 0) {
            console.warn(`⚠️ Spot ${index + 1}: 画像がありません`);
            return;
        }

        // 画像の高さが確定するまで待つ（非同期に調整）
        let totalImageHeight = 0;

        images.forEach(image => {
            image.onload = () => {
                totalImageHeight += image.clientHeight;
                console.log(`📷 画像の高さ: ${image.clientHeight}px, 合計: ${totalImageHeight}px`);
                applyHeightAdjustment(description, totalImageHeight);
            };
        });

        // すでに読み込まれている画像の高さも考慮
        setTimeout(() => {
            images.forEach(image => {
                totalImageHeight += image.clientHeight;
            });
            console.log(`📏 [Spot ${index + 1}] 画像の合計高さ: ${totalImageHeight}px, 説明の高さ: ${description.scrollHeight}px`);
            applyHeightAdjustment(description, totalImageHeight);
        }, 500);
    });
}

// 🔥 高さ調整の適用ロジックを関数化
function applyHeightAdjustment(description, totalImageHeight) {
    if (!description) return;

    let descriptionHeight = description.scrollHeight;

    if (descriptionHeight > totalImageHeight) {
        console.log("🟢 説明文が長いので高さ制限を適用");
        description.style.maxHeight = totalImageHeight + "px";
        description.style.overflowY = "auto";
    } else {
        console.log("🔵 説明文が短いので制限なし");
        description.style.maxHeight = "none";
        description.style.overflowY = "hidden";
    }
}

// 🔥 ページの読み込み時とリサイズ時に実行
window.addEventListener("load", adjustDescriptionHeight);
window.addEventListener("resize", adjustDescriptionHeight);

