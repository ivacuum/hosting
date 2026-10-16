<?php

namespace App\Http\Controllers;

use App\Domain\Magnet\Models\Magnet;
use App\Domain\SessionKey;
use App\Domain\Telegram\Action\NotifyAdminViaTelegramAction;
use App\Http\Requests\MagnetRequestReleaseForm;

class MagnetRequestReleaseController
{
    public function __invoke(MagnetRequestReleaseForm $request, NotifyAdminViaTelegramAction $notifyAdminViaTelegram)
    {
        $link = Magnet::externalSearchLink($request->q);
        $user = $request->user->email ?? 'anonymous';
        $comment = $request->comment
            ? "\n\n" . mb_substr($request->comment, 0, 500)
            : '';

        event(new \App\Events\Stats\TorrentReleaseRequested);

        $notifyAdminViaTelegram->execute("🔎🧲 {$user} ищет раздачу\n\n{$request->q}\n{$link}{$comment}");

        return back()->with([SessionKey::FlashMessage->value => 'Запрос принят. Уведомления пока присылать не умеем, поэтому просим вскоре вернуться на сайт.']);
    }
}
