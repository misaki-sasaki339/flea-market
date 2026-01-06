document.addEventListener('DOMContentLoaded', () => {

    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        ?.getAttribute('content');

    // メッセージの編集
    const form = document.getElementById('message-form');
    if (form) {

        const textarea = form.querySelector('textarea[name="body"]');
        const hiddenId = document.getElementById('edit-message-id');
        const orderId = form.dataset.orderId;

        const storeAction = form.getAttribute('action');

        document.querySelectorAll('.chat-action__edit').forEach(button => {
            button.addEventListener('click', () => {
                const messageId = button.dataset.messageId;
                const messageBody = button.dataset.messageBody;

                textarea.value = messageBody;
                textarea.focus();

                hiddenId.value = messageId;

                form.setAttribute('action', `/messages/${messageId}`);

                if (!form.querySelector('input[name="_method"]')){
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PATCH';
                    form.appendChild(methodInput);
                }
            });
        });

        // 入力内容のセッション保存
        textarea.addEventListener('input', () => {
            fetch('/messages/draft', {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                order_id: orderId,
                body: textarea.value,
                }),
            });
        });
    };

    // レビューのモーダル表示
    const open = document.getElementById('review-modal_open');
    const close = document.getElementById('review-modal__close');
    const modal = document.getElementById('review-modal');
    const mask = document.getElementById('review-modal__mask');

    const openModal = () => {
        modal.classList.add('is-active');
        mask.classList.add('is-active');
    };

    const closeModal = () => {
        modal.classList.remove('is-active');
        mask.classList.remove('is-active');
    };

    // 購入者用
    if (open && close && modal && mask) {
        open.addEventListener('click', openModal);
        close.addEventListener('click', closeModal);
        mask.addEventListener('click', closeModal);
    }

    // 出品者用（自動）
    const autoOpen = document.getElementById('auto-open-review-modal');
    if (autoOpen && modal && mask) {
        openModal();
    }


    // レビューの星
    document.querySelectorAll('.review-star').forEach(star => {
        star.addEventListener('click', () => {
            const score = star.dataset.score;
            document.getElementById('review-score').value = score;

            document.querySelectorAll('.review-star').forEach(s => {
                s.classList.toggle('is-active', s.dataset.score <= score);
            });
        });
    });
});

