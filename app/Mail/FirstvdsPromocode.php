<?php namespace App\Mail;

use Illuminate\Mail\Mailable;

class FirstvdsPromocode extends Mailable
{
    public $locale;

    public function __construct()
    {
        $this->locale = \App::getLocale();
    }

    public function build()
    {
        return $this->subject(trans('coupons.firstvds.subject'))
            ->markdown('emails.coupons.firstvds');
    }
}
