<?php

namespace App\Mail;

use App\Model\Hospital;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    protected $hospital;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Hospital $hospital)
    {
        $this->hospital = $hospital;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.email_verification')->with('hospital', $this->hospital);
    }
}
