<?php namespace App\Listeners;

use App\Events\TorrentAddedAnonymously;
use Ivacuum\Generic\Listeners\TelegramNotifier;

class TelegramAnonymousTorrent extends TelegramNotifier
{
    public function handle(TorrentAddedAnonymously $event)
    {
        if (\App::runningInConsole()) {
            return;
        }

        $model = $event->model;

        $this->telegram->notifyAdmin("🧲️ Раздача добавлена анонимно\n\n{$model->title}\n{$model->www()}\n\n{$model->wwwAcp()}");
    }
}
