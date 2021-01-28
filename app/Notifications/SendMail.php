<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendMail extends Notification
{
    use Queueable;

    public $expense;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($expense)
    {
        $this->expense = $expense;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('Yeni harcama oluşturuldu.')
                    ->line('Miktar: '.$this->expense->amount)
                    ->line('Harcanan Yer: '.$this->expense->location)
                    ->line('Tarih: '.$this->expense->date)
                    ->action('Siteye Git', url('/'))
                    ->line('');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
