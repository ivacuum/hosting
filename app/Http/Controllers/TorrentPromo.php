<?php namespace App\Http\Controllers;

class TorrentPromo extends Controller
{
    public function index()
    {
        event(new \App\Events\Stats\TorrentPromoViewed);

        return view('torrent-promo.index');
    }
}
