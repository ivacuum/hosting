<?php

namespace App\Http\Controllers;

use App\Http\Requests\MagnetRequestReleaseForm;
use App\Magnet;
use Ivacuum\Generic\Services\Telegram;

class MagnetRequestReleaseController
{
    public function __invoke(MagnetRequestReleaseForm $request, Telegram $telegram)
    {
        $link = Magnet::externalSearchLink($request->q);
        $user = $request->user->email ?? 'anonymous';
        $comment = $request->comment
            ? "\n\n" . $request->comment
            : '';

        event(new \App\Events\Stats\TorrentReleaseRequested);

        $telegram->notifyAdmin("🔎🧲 {$user} ищет раздачу\n\n{$request->q}\n{$link}{$comment}");

        return back()->with(['message' => 'Запрос принят. Уведомления пока присылать не умеем, поэтому просим вскоре вернуться на сайт.']);
    }
}
