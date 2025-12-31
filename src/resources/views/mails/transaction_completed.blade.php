<div style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <p>{{ $order->item->user->name }} さん</p>

    <h2 style="font-size: 16px; margin-top: 24px;">
        取引完了のお知らせ
    </h2>

    <p>
        「{{ $order->item->name }}」の取引が完了しました。
    </p>

    <p>
        下記リンクより、取引内容をご確認ください。
    </p>

    <p style="margin: 24px 0;">
        <a href="{{ route('messages.show', $order) }}"
           style="
                display: inline-block;
                padding: 10px 16px;
                background-color: #f5c542;
                color: #000;
                text-decoration: none;
                border-radius: 4px;
                font-weight: bold;
           ">
            取引チャットを確認する
        </a>
    </p>

    <p style="font-size: 14px; color: #666;">
        COACHTECH運営
    </p>
</div>
