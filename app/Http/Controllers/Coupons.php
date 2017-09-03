<?php namespace App\Http\Controllers;

use App\Mail\FirstvdsPromocode;

class Coupons extends Controller
{
    public function index()
    {
        return view($this->view);
    }

    public function airbnb()
    {
        $month = intval(date('m'));
        $year = date('Y');

        $meta_title = trans('coupons.airbnb.title', [
            'month' => trans("months.$month"),
            'year' => $year
        ]);

        return view($this->view, compact('meta_title'));
    }

    public function digitalocean()
    {
        $month = intval(date('m'));
        $year = date('Y');

        $meta_title = trans('coupons.do.title', [
            'month' => trans("months.$month"),
            'year' => $year
        ]);

        return view($this->view, compact('meta_title'));
    }

    public function firstvds()
    {
        return view($this->view);
    }

    public function firstvdsPost()
    {
        request()->validate([
            'mail' => 'empty',

            'email' => 'required|email|max:125',
        ]);

        \Mail::to(request('email'))->queue(new FirstvdsPromocode);

        return back()->with('message', trans('coupons.promocode_sent'));
    }

    public function timeweb()
    {
        \Breadcrumbs::push(trans('coupons.timeweb'));

        return view($this->view);
    }

    protected function appendBreadcrumbs()
    {
        $this->middleware('breadcrumbs:coupons.index,promocodes-coupons');
        $this->middleware('breadcrumbs:coupons.airbnb')->only('airbnb');
        $this->middleware('breadcrumbs:coupons.digitalocean')->only('digitalocean');
        $this->middleware('breadcrumbs:coupons.firstvds')->only('firstvds');
    }
}
