document.addEventListener("DOMContentLoaded", () => {
    // ===== モーダル初期化処理 =====
    document.querySelectorAll('.edit-modal').forEach(modal => {
        modal.addEventListener('shown.bs.modal', function () {
            const textarea = modal.querySelector('textarea');
            textarea?.focus();

            const questbodyId = modal.id.replace('edit-questbody-', '');
            const fileInput = modal.querySelector(`#edit-image-${questbodyId}`);
            const uploadBtn = modal.querySelector(`#upload-btn-${questbodyId}`);
            const newImagesWrapper = modal.querySelector(`#image-list-wrapper-${questbodyId}`);
            const hiddenInputContainer = modal.querySelector(`#hidden-inputs-${questbodyId}`);

            const existingImages = window.questBodyImages[questbodyId] || [];
            hiddenInputContainer.innerHTML = "";
            const seen = new Set();

            existingImages.forEach(imgPath => {
                if (!seen.has(imgPath)) {
                    seen.add(imgPath);
                    const input = document.createElement("input");
                    input.type = "hidden";
                    input.name = "existing_images[]";
                    input.value = imgPath;
                    hiddenInputContainer.appendChild(input);
                }
            });

            let uploadedImagesList = [];

            if (fileInput && uploadBtn && newImagesWrapper) {
                uploadBtn.disabled = true;

                fileInput.addEventListener("change", () => {
                    uploadBtn.disabled = fileInput.files.length === 0;
                });

                uploadBtn.addEventListener("click", (event) => {
                    event.preventDefault();
                    if (fileInput.files.length === 0) return alert("ファイルを選択してください");
                    Array.from(fileInput.files).forEach(file => uploadedImagesList.push(file));
                    renderNewImages();
                    fileInput.value = "";
                    uploadBtn.disabled = true;
                });

                function renderNewImages() {
                    newImagesWrapper.querySelectorAll(".new-uploaded-image").forEach(el => el.remove());

                    uploadedImagesList.forEach((file, index) => {
                        const fileItem = document.createElement("div");
                        fileItem.classList.add("col-auto", "text-center", "me-2", "position-relative", "new-uploaded-image");

                        const reader = new FileReader();
                        reader.onload = function (e) {
                            const thumbnail = document.createElement("img");
                            thumbnail.classList.add("img-thumbnail");
                            thumbnail.src = e.target.result;
                            thumbnail.alt = `Uploaded Image ${index + 1}`;
                            thumbnail.style.width = "150px";
                            thumbnail.style.height = "auto";
                            fileItem.appendChild(thumbnail);
                        };
                        reader.readAsDataURL(file);

                        const deleteButton = document.createElement("button");
                        deleteButton.classList.add("btn", "btn-sm", "btn-red", "position-absolute", "bottom-0", "end-0", "m-1", "text-white");
                        deleteButton.innerHTML = "<i class='fa-solid fa-trash'></i>";
                        deleteButton.addEventListener("click", function () {
                            uploadedImagesList.splice(index, 1);
                            renderNewImages();
                        });

                        fileItem.appendChild(deleteButton);
                        newImagesWrapper.appendChild(fileItem);
                    });
                }

                const submitBtn = modal.querySelector("button.update-btn");
                const form = modal.querySelector("form");

                submitBtn?.addEventListener("click", async function (event) {
                    event.preventDefault();

                    const introInput = modal.querySelector(`#introduction_${questbodyId}`);
                    const businessTitleInput = modal.querySelector(`#business_title_${questbodyId}`);

                    const introError = modal.querySelector(`#intro-error-${questbodyId}`);
                    const imageError = modal.querySelector(`#image-error-${questbodyId}`);
                    const businessTitleError = modal.querySelector(`#business-title-error-${questbodyId}`);

                    const roleId = parseInt(window.authRoleId);
                    let hasError = false;

                    if (!introInput?.value.trim()) { introError?.classList.remove("d-none"); hasError = true; } else { introError?.classList.add("d-none"); }
                    if (roleId === 2 && (!businessTitleInput?.value.trim())) { businessTitleError?.classList.remove("d-none"); hasError = true; } else { businessTitleError?.classList.add("d-none"); }

                    const totalImages = uploadedImagesList.length + hiddenInputContainer.querySelectorAll(`input[name="existing_images[]"]`).length;
                    if (totalImages === 0) { imageError?.classList.remove("d-none"); hasError = true; } else { imageError?.classList.add("d-none"); }

                    if (hasError) return;

                    const formData = new FormData(form);
                    uploadedImagesList.forEach(file => {
                        formData.append("images[]", file);
                    });
                    
                    try {
                        const response = await fetch(form.action, {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                            },
                            body: formData
                        });

                        const result = await response.json();

                        if (result.status === 'success') {
                            console.log("✅ 保存成功:", result);
                            // 保存後にリロード or モーダル閉じる処理など
                            window.location.reload(); // ← 任意の動作
                        } else {
                            console.error("⚠️ サーバー側エラー:", result);
                            alert("保存に失敗しました。");
                        }

                    } catch (error) {
                        console.error("❌ 通信エラー:", error);
                        alert("通信エラーが発生しました。");
                    }
                });
            }

            modal.querySelectorAll('.remove-existing-image').forEach(button => {
                button.addEventListener('click', function () {
                    const imagePath = this.dataset.img;
                    this.closest('.col-auto')?.remove();
                    modal.querySelectorAll(`input[name="existing_images[]"][value="${imagePath}"]`).forEach(input => input.remove());
                    console.log("🗑 クライアント側で削除:", imagePath);
                });
            });

            console.log("✅ モーダルID:", modal.id, "に処理がバインドされました");
        });

        // モーダル閉じる直前にフォーカスを外す
        modal.addEventListener('hide.bs.modal', () => {
            const active = document.activeElement;
            if (modal.contains(active)) {
                active.blur();
                document.body.setAttribute('tabindex', '-1');
                document.body.focus();
                document.body.removeAttribute('tabindex');
            }
        });
    });
});
