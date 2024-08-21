<?php

namespace App\Notifications\Api\V1\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\URL;

class VerifyEmail extends Notification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public static $createUrlCallback;
    public static $toMailCallback;

    /**
     * Create a new notification instance.
     */
    public function __construct(private readonly object $user)
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

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $verificationUrl);
        }

        return $this->buildMailMessage($verificationUrl);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function buildMailMessage($url): MailMessage
    {

        return (new MailMessage)
            ->subject(Lang::get('Verificação de Email'))
            ->line(
                Lang::get(
                    'Você está recebendo este e-mail porque recebemos uma solicitação de registro de conta.',
                ),
            )
            ->action(Lang::get('Verificar Email'), $url)
            ->line(
                Lang::get('Este link de verificação email expirará em 60 minutos.', [
                    'count' => config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
                ]),
            )
            ->line(Lang::get('Se você não solicitou um registro de conta, nenhuma outra ação será necessária.'))
            ->line('Atenciosamente,');
    }

    protected function verificationUrl($notifiable)
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable);
        }

        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
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
