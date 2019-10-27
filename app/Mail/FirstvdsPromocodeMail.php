<?php namespace App\Mail;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;

class FirstvdsPromocodeMail extends Mailable implements ShouldQueue
{
    public function build()
    {
        return $this->subject(trans('coupons.firstvds.subject'))
            ->markdown('emails.coupons.firstvds')
            ->with('locale', $this->locale);
    }
}
