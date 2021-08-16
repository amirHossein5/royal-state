<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
        private User $notifiable,
        private string $token
    ) {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->notifiable->getEmailForPasswordReset())
            ->view(
                'emails.reset-password',
                ['url' => $this->url()]
            );
    }

    public function url(): string
    {
        return url(route('password.reset', [
            'token' => $this->token,
            'email' => $this->notifiable->getEmailForPasswordReset(),
        ], false));
    }
}
