document.addEventListener("DOMContentLoaded", () => {
    const sections = document.querySelectorAll(".reveal-section");
    sections.forEach((section) => {
        section.classList.add("revealed");
    });
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

        // 画像の高さが確定するまで待つ（非同期に調整）
        let totalImageHeight = 0;
        let images = imageContainer.querySelectorAll("img");

        if (images.length === 0) {
            console.warn(`⚠️ Spot ${index + 1}: 画像がありません`);
            return;
        }

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

//=====================================================Like================================
document.querySelectorAll('.like-form').forEach(form => {
    form.querySelector('.like-btn').addEventListener('click', async function () {
        const btn = form.querySelector('.like-btn');
        btn.disabled = true;

        const questId = form.dataset.questId;
        const token = form.querySelector('input[name="_token"]').value;

        try {
            // 🔁 ライクのトグル処理
            const response = await fetch(`/quest/${questId}/toggle-like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                const errorHtml = await response.text();
                console.error("❌ fetch失敗:", errorHtml);
                return;
            }

            const result = await response.json();

            // ✅ アイコン更新
            const icon = form.querySelector('.like-btn i');
            icon.classList.remove('fa-regular', 'fa-solid', 'text-danger');
            if (result.liked) {
                icon.classList.add('fa-solid', 'text-danger');
            } else {
                icon.classList.add('fa-regular');
            }

            // ✅ カウント更新
            const countSpans = document.querySelectorAll(`.like-count[data-quest-id="${questId}"]`);
            countSpans.forEach(span => {
                span.textContent = result.like_count;
            });

            // ✅ モーダルの中身更新
            const modalBody = document.querySelector(`#likes-modal-${questId} .modal-body`);
            if (modalBody) {
                const likesResponse = await fetch(`/quest/${questId}/likes`);
                if (!likesResponse.ok) {
                    throw new Error("モーダル用のいいねリスト取得に失敗しました");
                }

                const users = await likesResponse.json();

                modalBody.innerHTML = "";

                if (users.length === 0) {
                    modalBody.innerHTML = "<p class='text-center text-muted'>No likes yet.</p>";
                } else {
                    users.forEach(user => {
                        const avatarHtml = user.avatar
                            ? `<img src="${user.avatar}" alt="" class="rounded-circle avatar-sm">`
                            : `<i class="fa-solid fa-circle-user text-secondary icon-mmd text-center"></i>`;

                        const followButtonHtml = user.is_own
                            ? ''
                            : `
                            <div class="col-3 text-end">
                                <form class="follow-toggle-form" data-user-id="${user.id}">
                                    <button type="button" class="btn px-3 py-0 ${user.is_followed ? 'btn-following' : 'btn-follow'}">
                                        ${user.is_followed ? 'Following' : 'Follow'}
                                    </button>
                                </form>
                            </div>`;

                        modalBody.innerHTML += `
                            <div class="row align-items-center mb-3">
                                <div class="col-2 d-flex justify-content-center">
                                    ${avatarHtml}
                                </div>
                                <div class="col-7">
                                    <a href="#" class="text-decoration-none text-dark fw-bold">
                                        ${user.name}
                                    </a>
                                </div>
                                ${followButtonHtml}
                            </div>
                        `;
                    });
                }
            }

        } catch (error) {
            console.error("🚨 JSエラー:", error);
        }

        btn.disabled = false;
    });
});



//==============================================-Like Modal
console.log("🔍 follow-toggle-form を探しています");

document.querySelectorAll('.follow-toggle-form button').forEach(button => {
    button.addEventListener('click', async function (e) {
        e.preventDefault();

        const parent = button.closest('.follow-toggle-form');
        const userId = parent.dataset.userId;
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(`/quest/follow/${userId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });

            if (!response.ok) {
                const errorText = await response.text();
                console.error("❌ サーバーエラー:", errorText);
                return;
            }

            const result = await response.json();

            if (result.is_following) {
                button.classList.remove('btn-follow');
                button.classList.add('btn-following');
                button.textContent = 'Following';
            } else {
                button.classList.remove('btn-following');
                button.classList.add('btn-follow');
                button.textContent = 'Follow';
            }

        } catch (error) {
            console.error("🚨 JSエラー:", error);
        }
    });
});


// // コメント数＆いいね情報の取得と描画
// async function fetchCommentStats(questId) {
//     try { 
//         const res = await fetch(`/quest/${questId}/comments/stats`);
        
//         if (!res.ok) throw new Error("ステータスエラー");
//         const data = await res.json();


//     // コメント数更新
//     const commentCountLabel = document.querySelector('.comment-count');
//     if (commentCountLabel) {
//         commentCountLabel.textContent = `Comments(${data.comment_count})`;
//     }

//     // 各コメントのいいね状態更新
//     data.comment_stats.forEach(stat => {
//         const likeBtn = document.querySelector(`.comment-like-btn[data-comment-id="${stat.id}"]`);
//         const countSpan = document.querySelector(`.comment-like-count[data-comment-id="${stat.id}"]`);

//         if (likeBtn && countSpan) {
//             countSpan.textContent = stat.like_count;
//             likeBtn.classList.toggle('liked', stat.liked_by_auth_user);
//         }
//     });

// } catch (err) {
//     console.error("❌ fetchCommentStats エラー:", err);
// }
// }

// // コメントのいいね切り替え処理 
// function setupCommentLikeHandlers() { 
//     const buttons = document.querySelectorAll('.comment-like-btn');

//     buttons.forEach(btn => {
//     btn.addEventListener('click', async () => {
//         const commentId = btn.dataset.commentId;
//         const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

//         try {
//             const res = await fetch(`/comment/${commentId}/toggle-like`, {
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': token,
//                     'Content-Type': 'application/json',
//                     'Accept': 'application/json',
//                 },
//             });

//             if (!res.ok) {
//                 const errorText = await res.text();
//                 console.error("❌ エラー:", errorText);
//                 return;
//             }

//             const result = await res.json();

//             const countSpan = document.querySelector(`.comment-like-count[data-comment-id="${commentId}"]`);
//             if (countSpan) {
//                 countSpan.textContent = result.like_count;
//             }

//             btn.classList.toggle('liked', result.liked);

//         } catch (error) {
//             console.error("🚨 JSエラー:", error);
//         }
//     });
// });
// }












    