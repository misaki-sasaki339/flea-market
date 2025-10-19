<?php

namespace App\Notifications;


use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Auth\Notifications\VerifyEmail as BaseVerifyEmail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class VerifyEmailNotification extends BaseVerifyEmail
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */

    protected function verificationUrl($notifiable)
    {
        $temporarySignedUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );

        return $temporarySignedUrl;
    }

    public function toMail($notifiable)
    {
        $verifyUrl = $this->verificationUrl($notifiable);
        return (new MailMessage)
            ->subject('【仮登録完了】メールアドレスの確認をお願いします')
            ->greeting($notifiable->name . ' 様')
            ->line('このたびはご登録ありがとうございます。')
            ->line('以下のボタンをクリックして、本登録を完了してください。')
            ->action('メールアドレスを確認する', $verifyUrl)
            ->line('このリンクの有効期限は60分です。')
            ->line('このメールにお心当たりがない場合は、破棄してください。')
            ->salutation('COACHTECH運営');
    }
}
