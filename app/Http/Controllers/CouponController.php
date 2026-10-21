<?php

namespace App\Http\Controllers;

use App\Domain\SessionKey;
use App\Http\Requests\CouponFirstvdsForm;
use App\Mail\FirstvdsPromocodeMail;

class CouponController
{
    public function airbnb()
    {
        return $this->coupon('coupons.airbnb', 'coupons.airbnb.title');
    }

    public function booking()
    {
        return $this->coupon('coupons.booking', 'coupons.booking.title');
    }

    public function digitalocean()
    {
        return $this->coupon('coupons.digitalocean', 'coupons.do.title');
    }

    public function drimsim()
    {
        return $this->coupon('coupons.drimsim', 'coupons.drimsim.title');
    }

    public function firstvds(CouponFirstvdsForm $request)
    {
        \Mail::to($request->email)
            ->locale(\App::getLocale())
            ->send(new FirstvdsPromocodeMail);

        return back()->with(SessionKey::FlashMessage->value, __('coupons.promocode_sent'));
    }

    public function timeweb()
    {
        return $this->coupon('coupons.timeweb', 'coupons.timeweb.title');
    }

    private function coupon(string $view, string $titleKey)
    {
        $heading = __($titleKey, [
            'month' => now()->isoFormat('MMMM'),
            'year' => now()->year,
        ]);

        \Head::title($heading);

        return view($view, ['heading' => $heading]);
    }
}
