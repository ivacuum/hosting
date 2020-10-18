<?php namespace App\Http\Controllers;

class TorrentPromo extends Controller
{
    public function __invoke()
    {
        event(new \App\Events\Stats\TorrentPromoViewed);

        return view('torrent-promo');
    }
}
