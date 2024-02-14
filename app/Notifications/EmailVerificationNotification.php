<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * A classe EmailVerificationNotification de notificação de e-mail é utilizada para enviar o e-mail ao usuário
 * notificando-o que é necessário fazer a verificação do e-mail.
 *
 * Esta classe recebe um link que contém o token de verificação que será enviado ao e-mail do usuário
 */

class EmailVerificationNotification extends Notification
{
    use Queueable;

    protected $url; // Variável que terá o token de verificação que será enviado ao e-mail do usuário.

    /**
     * Create a new notification instance.
     */
    public function __construct($url)
    {
        $this->url = $url;
    }

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
     * Mensagem que será enviada no e-mail do usuário junto com o token que o
     * usuário usará para verificar seu e-mail.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Verificação de endereço de e-mail')
                    ->line("Olá, $notifiable->name")
                    ->line('Obrigada por assinar nosso app!')
                    ->action('Verificar e-mail', $this->url)
                    ->line('Se você não criou uma conta, nenhuma ação adicional será necessária de sua parte.');
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
