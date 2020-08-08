<?php namespace App\Http\Controllers;

use App\Mail\FirstvdsPromocodeMail;
use App\Rules\Email;

class Coupons extends Controller
{
    public function __construct()
    {
        $this->middleware('nav:coupons.index,promocodes-coupons');
        $this->middleware('nav:coupons.airbnb')->only('airbnb');
        $this->middleware('nav:coupons.booking')->only('booking');
        $this->middleware('nav:coupons.digitalocean')->only('digitalocean');
        $this->middleware('nav:coupons.drimsim')->only('drimsim');
        $this->middleware('nav:coupons.firstvds')->only('firstvds');
        $this->middleware('nav:coupons.timeweb')->only('timeweb');
    }

    public function index()
    {
        return view('coupons.index');
    }

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
        return view('coupons.firstvds');
    }

    public function firstvdsPost()
    {
        request()->validate(['email' => Email::rules()]);

        \Mail::to(request('email'))
            ->locale(\App::getLocale())
            ->send(new FirstvdsPromocodeMail);

        return back()->with('message', trans('coupons.promocode_sent'));
    }

    public function timeweb()
    {
        return view('coupons.timeweb', ['metaTitle' => $this->getServiceMetaTitle('timeweb')]);
    }

    protected function getServiceMetaTitle(string $service): string
    {
        $month = intval(date('m'));
        $year = date('Y');

        return trans("coupons.{$service}.title", [
            'month' => trans("months.$month"),
            'year' => $year
        ]);
    }
}
