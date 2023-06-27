<?php

namespace App\Listeners;

use App\Events\IssueCreated;
use Ivacuum\Generic\Listeners\TelegramNotifier;

class TelegramIssue extends TelegramNotifier
{
    public function handle(IssueCreated $event)
    {
        $model = $event->model;

        if (\App::runningInConsole()) {
            return;
        }

        $text = "💡 Обратная связь {$model->id} от {$model->email}\n{$model->title}\n" . url($model->page) . "\n\n" . htmlspecialchars_decode($model->text, ENT_QUOTES);

        $this->telegram->notifyAdmin($text);
    }
}
