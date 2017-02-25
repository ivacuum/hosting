<?php namespace App\Mail;

use Illuminate\Mail\Mailable;

class FirstvdsPromocode extends Mailable
{
    public function build()
    {
        return $this->subject(trans('coupons.firstvds.subject'))
            ->markdown('emails.coupons.firstvds');
    }
}
