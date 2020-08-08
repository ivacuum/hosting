<?php namespace App\Http\Controllers;

use App\Http\Requests\TorrentRequestReleaseRequest;
use App\Torrent;
use Ivacuum\Generic\Services\Telegram;

class TorrentRequestRelease extends Controller
{
    public function __invoke(TorrentRequestReleaseRequest $request, Telegram $telegram)
    {
        $link = Torrent::externalSearchLink($request->q());
        $user = $request->userModel()->email ?? 'anonymous';
        $comment = $request->comment()
            ? "\n\n" . $request->comment()
            : '';

        event(new \App\Events\Stats\TorrentReleaseRequested);

        $telegram->notifyAdmin("🔎🧲 {$user} ищет раздачу\n\n{$request->q()}\n{$link}{$comment}");

        return back()->with(['message' => 'Запрос принят. Уведомления пока присылать не умеем, поэтому просим вскоре вернуться на сайт.']);
    }
}
