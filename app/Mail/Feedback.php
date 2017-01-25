<?php namespace App\Mail;

use Illuminate\Mail\Mailable;

class Feedback extends Mailable
{
    public $text;
    public $referer;
    public $question;

    public function __construct($referer, $question, $text)
    {
        $this->text = $text;
        $this->referer = $referer;
        $this->question = $question;
    }

    public function build()
    {
        return $this->to(config('email.support'))
            ->subject("Отзыв {$this->referer}")
            ->text('emails.feedback');
    }
}
