<?php namespace App\Http\Controllers;

use App\Mail\FirstvdsPromocodeMail;
use App\Rules\Email;

class Coupons extends Controller
{
    public function airbnb()
    {
        return view('coupons.airbnb', ['metaTitle' => $this->getServiceMetaTitle('airbnb')]);
    }

    public function booking()
    {
        return view('coupons.booking', ['metaTitle' => $this->getServiceMetaTitle('booking')]);
    }

    public function digitalocean()
    {
        return view('coupons.digitalocean', ['metaTitle' => $this->getServiceMetaTitle('do')]);
    }

    public function drimsim()
    {
        return view('coupons.drimsim', ['metaTitle' => $this->getServiceMetaTitle('drimsim')]);
    }

    public function firstvds()
    {
        request()->validate(['email' => Email::rules()]);

        \Mail::to(request('email'))
            ->locale(\App::getLocale())
            ->send(new FirstvdsPromocodeMail);

        return back()->with('message', __('coupons.promocode_sent'));
    }

    public function timeweb()
    {
        return view('coupons.timeweb', ['metaTitle' => $this->getServiceMetaTitle('timeweb')]);
    }

    protected function getServiceMetaTitle(string $service): string
    {
        $month = intval(date('m'));
        $year = date('Y');

        return __("coupons.{$service}.title", [
            'month' => __("months.$month"),
            'year' => $year,
        ]);
    }
}
