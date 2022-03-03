<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuditMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dataArray)
    {
        //
         $this->dataArray= $dataArray;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
         $address = 'shanu.kk@bourntec.com';
        $name = 'BOURNTEC TEAM';
        $subject = 'USER CREDENTIALS';
      return $this->view('email.AuditMail')
                ->from($address, $name)
                ->cc($address, $name)
                ->bcc($address, $name)
                ->replyTo($address, $name)
                ->subject($subject)
               ->with([
                        'name' => $this->dataArray['name'],
                        'password' => $this->dataArray['password'],
                        'E_id' => $this->dataArray['E_id'],
                        'email' => $this->dataArray['username'],
                   
                   
                    ]);
        // echo 'shanu';exit;
       
               
       
    }
}
