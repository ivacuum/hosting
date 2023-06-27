<?php

namespace App\Http\Controllers;

class TorrentPromoController
{
    public function __invoke()
    {
        event(new \App\Events\Stats\TorrentPromoViewed);

        return view('torrent-promo');
    }
}
