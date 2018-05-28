<?php

namespace App\Mail;

use App\Models\SignUp;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SignUpMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $signup;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SignUp $signup)
    {
        $this->signup = $signup;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.signup')->subject('Voltooi uw registratie')->with([
            'name' => $this->signup->name,
            'company_name' => $this->signup->company_name,
            'token' => $this->signup->token
        ]);
    }
}
