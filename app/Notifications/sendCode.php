<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class sendCode extends Notification
{
    use Queueable;


    public function __construct()
    {
        //
    }


    public function via(object $notifiable): array
    {
        return ['mail'];
    }


    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('verification code')
                    ->line('Your Verification code is .', $notifiable->code);
    }


    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
