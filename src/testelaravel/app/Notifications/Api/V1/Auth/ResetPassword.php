<?php

namespace App\Notifications\Api\V1\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class ResetPassword extends Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly string $token)
    {
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
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(Lang::get('Notificação de redefinição de senha'))
            ->greeting(Lang::get('Olá')." {$notifiable->full_name},")
            ->line(
                Lang::get(
                    'Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de 
                senha para sua conta.',
                ),
            )
            ->action(
                Lang::get('Redefinir senha'),
                url().'/reset-password/'.$notifiable->email.'/'.$this->token,
            )
            ->line(
                Lang::get('Este link de redefinição de senha expirará em 60 minutos.', [
                    'count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
                ]),
            )
            ->line(Lang::get('Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária.'))
            ->line('Atenciosamente,');
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
