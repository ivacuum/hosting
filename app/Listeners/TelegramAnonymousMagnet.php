<?php

namespace App\Listeners;

use App\Events\MagnetAddedAnonymously;
use Ivacuum\Generic\Listeners\TelegramNotifier;

class TelegramAnonymousMagnet extends TelegramNotifier
{
    public function handle(MagnetAddedAnonymously $event)
    {
        if (\App::runningInConsole()) {
            return;
        }

        $model = $event->model;

        $this->telegram->notifyAdmin("🧲️ Раздача добавлена анонимно\n\n{$model->title}\n{$model->www()}\n\n{$model->wwwAcp()}");
    }
}
