<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CodigoVerificacion extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
  public function __construct(
    public string $codigo
) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
   public function toMail(object $notifiable): MailMessage
{
    return (new MailMessage)
        ->subject('Código de verificación')
        ->greeting('Hola, administrador')
        ->line('Tu código de verificación es:')
        ->line($this->codigo)
        ->line('Este código vence en 5 minutos.')
        ->line('Si no solicitaste este código, ignora este correo.');
}

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
