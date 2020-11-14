<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class publish extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public  $instAccount;
    public  $instPassowrd;
    public  $userNots;
    public  $userEmail;
    public  $userPassword;


    public function __construct($instAccount,$instPassowrd,$userNots,$userEmail,$userPassword)
    {
        $this->instAccount =  $instAccount;
        $this->instPassowrd =  $instPassowrd;
        $this->userNots =  $userNots;
        $this->userEmail =  $userEmail;
        $this->userPassword =  $userPassword;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('user.publish.email');
    }
}
