<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPasswordEmail extends Notification {

    use Queueable;

    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token) {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable) {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        $name = config('app.name');
        if ($notifiable->role == 'normal') {
            return (new MailMessage)
                            ->subject("Reset Your Password | $name")
                            ->line('You are receiving this email because we received a password reset request for your account.')
                            ->action('Reset Password', route('front_password_email_token', $this->token) . '?email=' . urlencode($notifiable->email))
                            ->line('If you did not request a password reset, no further action is required.');
        }
        if ($notifiable->role == 'admin') {
            return (new MailMessage)
                            ->subject("Reset Your Password | $name")
                            ->line('You are receiving this email because we received a password reset request for your account.')
                            ->action('Reset Password', route('admin_password_email_token', $this->token) . '?email=' . urlencode($notifiable->email))
                            ->line('If you did not request a password reset, no further action is required.');
        }
        exit;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable) {
        return [
                //
        ];
    }

}
