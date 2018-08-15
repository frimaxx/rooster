<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailUserCredentials extends Mailable
{
    use Queueable, SerializesModels;

    protected $credentials = [];

    /**
     * Create a new message instance.
     *
     * @param array $credentials
     * @return void
     */
    public function __construct($credentials)
    {
        $this->credentials = $credentials;
     }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.credentials', $this->credentials)->subject('Uw inloggegevens bij Rooster');
    }
}
