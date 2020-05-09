<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public $text;
    public $book_name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$book_name,$text,$subject)
    {
        $this->user = $user;
        $this->text = $text;
        $this->subject = $subject;
        $this->book_name = $book_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('email');
    }
}
