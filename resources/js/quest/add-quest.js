//page refredh
window.addEventListener("beforeunload", function() {
    localStorage.clear();
});
// load==========================================================
// **アップロードした画像を保存するリスト**
let uploadedImagesList = []; 

// 📌 アップロードしたファイル名と削除ボタンを `uploaded-file-names` に表示
function updateUploadedFileNames() {
    const uploadedFileNames = document.getElementById("uploaded-file-names");
    uploadedFileNames.innerHTML = ""; // 一旦クリアして再表示

    uploadedImagesList.forEach((imageSrc, index) => {
        const fileItem = document.createElement("div");
        fileItem.classList.add("uploaded-file-item", "d-flex", "align-items-center", "justify-content-between");

        // **🖼 サムネイル画像を追加**
        const thumbnail = document.createElement("img");
        thumbnail.classList.add("photo-thumbnail", "me-2"); // スタイル用のクラスを追加
        thumbnail.src = imageSrc; // Base64データを設定
        thumbnail.alt = `Uploaded Image ${index + 1}`;
        thumbnail.style.width = "6.25rem"; // サムネイルのサイズ指定
        thumbnail.style.objectFit = "cover"; // 画像を枠内に収める

        // **❌ 削除ボタン**
        const deleteButton = document.createElement("button");
        deleteButton.classList.add("btn", "btn-sm", "btn-red", "ms-2");
        deleteButton.innerHTML = "<i class='fa-solid fa-trash'></i>";
        deleteButton.addEventListener("click", function () {
            removeImage(index);
        });

        fileItem.appendChild(thumbnail);
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
        const fileInput = document.getElementById("spot-images");
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

    // **選択されたファイルを `uploadedImagesList` に追加**
    Array.from(fileInput.files).forEach(file => {
        const reader = new FileReader();
        reader.onload = function (e) {
            uploadedImagesList.push(e.target.result); // Base64データを保存
            updateUploadedFileNames(); // **ファイルリストを更新**
        };
        reader.readAsDataURL(file);
    });

    // **ファイルインプットをクリア**
    fileInput.value = "";
    uploadBtn.disabled = true;
    });


        console.log("✅ フォーム2のリスナーを適用しました！");
    }

    // `form2` が表示されたらリスナーを適用
    document.getElementById("submit1").addEventListener("click", function () {
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
document.getElementById("submit1").addEventListener("click", function(event) {
    event.preventDefault(); // フォーム送信を防ぐ

    console.log("Createボタンがクリックされました！");

    // 入力値を取得
    const title = document.getElementById("title").value;
    const startDate = document.getElementById("start_date").value;
    const endDate = document.getElementById("end_date").value;
    const intro = document.getElementById("intro").value;
    const fileInput = document.getElementById("h_photo");

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
    const daySelect = document.getElementById("day_select");
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
        console.error("day_selectが見つかりません");
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
});


// ======================================FORM2=============================================================d
let spotList = JSON.parse(localStorage.getItem("spotList")) || []; // 保存済みのデータを取得

document.getElementById("addon").addEventListener("click", function(event) {
    event.preventDefault();
    console.log("🛠 ADD SPOT ボタンが押されました");

    // 入力値の取得
    const day = parseInt(document.getElementById("day_select").value, 10) || 1;
    const spot = document.getElementById("spot-name").value;
    const description = document.getElementById("spot-description").value;
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

    // **🔥 `localStorage` を削除（少し遅らせる）**
    setTimeout(() => {
        localStorage.removeItem("spotList"); // `spotList` だけ削除
        console.log("🗑️ `spotList` を削除しました");
    }, 500); // 0.5秒後に削除

    clearForm2(); // 入力をクリア
    
    document.getElementById("confirmBtn").classList.remove("d-none");
    console.log("Confirm button の d-none を削除しました！");
});

    function saveSpotData(day, spot, description, imageSrcList, isAgendaChecked) {
        const newSpot = { day, spot, description, images: imageSrcList, agenda: isAgendaChecked };
        console.log(newSpot);
        spotList.push(newSpot); // 新しいスポットをリストに追加
        localStorage.setItem("spotList", JSON.stringify(spotList)); // `localStorage` に保存

        displayAllSpots(); // 画面を更新
    }
    
    function displayAllSpots() {
        const dayContainer = document.getElementById("day-container");
        dayContainer.innerHTML = ""; // 画面をクリア
        console.log(dayContainer);

        spotList.sort((a, b) => a.day - b.day); // `day` の順番でソート

        spotList.forEach(spotData => {
            addSpotToContainer(spotData);
        });
    }

    function addSpotToContainer(spotData) {
        const dayContainer = document.getElementById("day-container");

        //check if the dame day is exist
        let dayElement = document.querySelector(`.day-group[data-day='${spotData.day}']`);

        //make a new day container
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

        // もし `dayElement` にすでにスポットがあるなら、区切り線を追加
        if (dayElement.children.length > 1) {
            const hr = document.createElement("hr");
            hr.classList.add("my-3"); // スペースを確保
            dayElement.appendChild(hr);
        }

        const spotElement = createSpotElement(spotData);
        dayElement.appendChild(spotElement);
    }

    function createSpotElement(spotData) {
        const template = document.getElementById("day-template");
        const newSpot = template.cloneNode(true);
        newSpot.classList.remove("d-none");

        // 必要なデータをセット
        newSpot.querySelector(".spot-name").textContent = spotData.spot;
        newSpot.querySelector(".spot-description").textContent = spotData.description;

        const imgContainer = newSpot.querySelector(".col-lg-6");
        imgContainer.innerHTML = ""; // 画像をクリアして追加

        spotData.images.forEach(src => {
            const spotImg = document.createElement("img");
            spotImg.classList.add("spot-image", "img-fluid","m-2", "d-block");
            spotImg.src = src;
            imgContainer.appendChild(spotImg);
        });

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
        document.getElementById("spot-name").value = "";
        document.getElementById("spot-description").value = "";
        document.getElementById("spot-image").value = "";
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