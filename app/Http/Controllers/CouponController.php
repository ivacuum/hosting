<?php

namespace App\Http\Controllers;

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
