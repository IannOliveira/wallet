<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TransferNotification extends Notification
{
    use Queueable;

    protected $amount;
    protected $recipient;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($amount, $recipient)
    {
        $this->amount = $amount;
        $this->recipient = $recipient;
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
            ->line('Você realizou uma transferência.')
            ->line('Valor: ' . $this->amount)
            ->line('Destinatário: ' . $this->recipient)
            ->line('Obrigado por usar nosso serviço!');
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
            'amount' => $this->amount,
            'recipient' => $this->recipient,
        ];
    }
}
