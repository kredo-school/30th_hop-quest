document.addEventListener("DOMContentLoaded", () => {
    document.body.addEventListener("click", async function (e) {
        const likeBtn = e.target.closest(".comment-like-btn");

        if (!likeBtn) return;

        e.preventDefault();

        const form = likeBtn.closest("form.like-comment-form");
        const commentId = form.dataset.commentId;
        const token = form.querySelector('input[name="_token"]').value;
        const icon = likeBtn.querySelector("i");
        const countSpan = document.querySelector(`.comment-like-count[data-comment-id="${commentId}"]`);

        try {
            const res = await fetch(`/questcomment/${commentId}/toggle-like`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": token,
                    "Accept": "application/json"
                }
            });

            if (!res.ok) {
                const err = await res.text();
                console.error("❌ エラー発生:", err);
                return;
            }

            const result = await res.json();

            // アイコンのクラス更新
            icon.classList.remove("fa-regular", "fa-solid", "text-danger");
            if (result.liked) {
                icon.classList.add("fa-solid", "text-danger");
            } else {
                icon.classList.add("fa-regular");
            }

            // いいね数更新
            if (countSpan) {
                countSpan.textContent = result.like_count;
            }

            console.log("💬 コメント liked:", result.liked, "count:", result.like_count);

        } catch (error) {
            console.error("🚨 JSエラー:", error);
        }
    });
});
