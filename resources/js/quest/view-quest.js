document.addEventListener('DOMContentLoaded', function () {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // モーダル表示時にリロード
    document.querySelectorAll('[id^="likes-modal-"]').forEach(modal => {
        modal.addEventListener('show.bs.modal', function () {
            const questId = this.id.replace('likes-modal-', '');
            refreshQuestLikesModal(questId);
        });
    });

    // Like トグル
    document.querySelectorAll('.btn-like-toggle').forEach(button => {
        button.addEventListener('click', async function () {
            const questId = this.dataset.questId;
            const liked = this.dataset.liked === '1';

            const url = `/quest/${questId}/toggle-like`;
            const method = 'POST'; // Spotと同じく POST でトグル


            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                    }
                });

                const data = await res.json();

                const icon = this.querySelector('.like-icon');
                const countElem = this.closest('.d-flex').querySelector('.like-count');

                if (liked) {
                    icon.classList.remove('fas', 'text-danger');
                    icon.classList.add('far');
                    this.dataset.liked = '0';
                    if (countElem) countElem.textContent = parseInt(countElem.textContent) - 1;
                } else {
                    icon.classList.remove('far');
                    icon.classList.add('fas', 'text-danger');
                    this.dataset.liked = '1';
                    if (countElem) countElem.textContent = parseInt(countElem.textContent) + 1;
                }

                refreshQuestLikesModal(questId);

            } catch (err) {
                console.error('❌ Like toggle failed:', err);
            }
        });
    });

    bindFollowButtons();
});

// モーダル中身更新
async function refreshQuestLikesModal(questId) {
    try {
        const res = await fetch(`/quest/${questId}/likes/html`);
        if (!res.ok) throw new Error('モーダルの取得に失敗');

        const html = await res.text();
        const oldModal = document.getElementById(`likes-modal-${questId}`);

        if (oldModal) {
            oldModal.outerHTML = html;
            const newModal = document.getElementById(`likes-modal-${questId}`);
            if (newModal) {
                newModal.addEventListener('show.bs.modal', function () {
                    refreshQuestLikesModal(questId);
                });
            }
        }

        bindFollowButtons();
    } catch (error) {
        console.error("🚨 モーダルHTML更新失敗:", error);
    }
}

// フォロー切替
function bindFollowButtons() {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.follow-toggle-form button').forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const parent = button.closest('.follow-toggle-form');
            const userId = parent.dataset.userId;

            const isCurrentlyFollowing = button.classList.contains('btn-following');
            const url = isCurrentlyFollowing
                ? `/follow/${userId}/delete`
                : `/follow/${userId}/store`;
            const method = isCurrentlyFollowing ? 'DELETE' : 'POST';

            try {
                const res = await fetch(url, {
                    method: method,
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                    }
                });

                const result = await res.json();

                if (result.message === 'Followed') {
                    button.classList.remove('btn-follow');
                    button.classList.add('btn-following');
                    button.textContent = 'Following';
                } else if (result.message === 'Unfollowed') {
                    button.classList.remove('btn-following');
                    button.classList.add('btn-follow');
                    button.textContent = 'Follow';
                }

            } catch (error) {
                console.error("❌ follow toggle failed:", error);
            }
        });
    });
}
