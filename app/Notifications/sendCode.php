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


    public function via( $notifiable)
    {
        return ['mail'];
    }



    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Verification Code')
            ->line('Your Verification code is: ' . $notifiable->code);
    }



    public function toArray( $notifiable)
    {
        return [
            //
        ];
    }
}
