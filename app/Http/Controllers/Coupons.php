<?php namespace App\Http\Controllers;

use App\Mail\FirstvdsPromocode;

class Coupons extends Controller
{
    public function index()
    {
        \Breadcrumbs::push(trans('coupons.index'));

        return view($this->view);
    }

    public function airbnb()
    {
        \Breadcrumbs::push(trans('coupons.index'), 'promocodes-coupons');
        \Breadcrumbs::push(trans('coupons.airbnb'));

        $month = intval(date('m'));
        $year = date('Y');

        $meta_title = trans('coupons.airbnb.title', ['month' => trans("months.$month"), 'year' => $year]);

        return view($this->view, compact('meta_title'));
    }

    public function digitalocean()
    {
        \Breadcrumbs::push(trans('coupons.index'), 'promocodes-coupons');
        \Breadcrumbs::push(trans('coupons.digitalocean'));

        $month = intval(date('m'));
        $year = date('Y');

        $meta_title = trans('coupons.do.title', ['month' => trans("months.$month"), 'year' => $year]);

        return view($this->view, compact('meta_title'));
    }

    public function firstvds()
    {
        \Breadcrumbs::push(trans('coupons.index'), 'promocodes-coupons');
        \Breadcrumbs::push(trans('coupons.firstvds'));

        return view($this->view);
    }

    public function firstvdsPost()
    {
        $this->validate($this->request, [
            'mail' => 'empty',
            'email' => 'required|email|max:125',
        ]);

        register_shutdown_function(function () {
            \Mail::to($this->request->input('email'))->send(new FirstvdsPromocode);
        });

        return back()->with('message', trans('coupons.promocode_sent'));
    }

    public function timeweb()
    {
        \Breadcrumbs::push(trans('coupons.index'), 'promocodes-coupons');
        \Breadcrumbs::push(trans('coupons.timeweb'));

        return view($this->view);
    }
}
