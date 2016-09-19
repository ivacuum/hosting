<?php namespace App\Mail;

use Illuminate\Mail\Mailable;

class Feedback extends Mailable
{
    public $question;
    public $referer;
    public $text;

    public function __construct($referer, $question, $text)
    {
        $this->referer  = $referer;
        $this->question = $question;
        $this->text     = $text;
    }

    public function build()
    {
        return $this->subject("Отзыв {$this->referer}")
            ->text('emails.feedback');
    }
}
