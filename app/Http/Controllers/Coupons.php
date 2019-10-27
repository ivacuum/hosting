<?php namespace App\Http\Controllers;

use App\Mail\FirstvdsPromocodeMail;
use App\Rules\Email;

class Coupons extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function airbnb()
    {
        return view($this->view, ['metaTitle' => $this->getServiceMetaTitle('airbnb')]);
    }

    public function booking()
    {
        return view($this->view, ['metaTitle' => $this->getServiceMetaTitle('booking')]);
    }

    public function digitalocean()
    {
        return view($this->view, ['metaTitle' => $this->getServiceMetaTitle('do')]);
    }

    public function drimsim()
    {
        return view($this->view, ['metaTitle' => $this->getServiceMetaTitle('drimsim')]);
    }

    public function firstvds()
    {
        return view($this->view);
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
        return view($this->view, ['metaTitle' => $this->getServiceMetaTitle('timeweb')]);
    }

    protected function appendBreadcrumbs(): void
    {
        $this->middleware('breadcrumbs:coupons.index,promocodes-coupons');
        $this->middleware('breadcrumbs:coupons.airbnb')->only('airbnb');
        $this->middleware('breadcrumbs:coupons.booking')->only('booking');
        $this->middleware('breadcrumbs:coupons.digitalocean')->only('digitalocean');
        $this->middleware('breadcrumbs:coupons.drimsim')->only('drimsim');
        $this->middleware('breadcrumbs:coupons.firstvds')->only('firstvds');
        $this->middleware('breadcrumbs:coupons.timeweb')->only('timeweb');
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
