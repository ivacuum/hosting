<?php namespace App\Observers;

use App\ChatMessage as Model;
use Ivacuum\Generic\Services\Telegram;

class ChatMessageObserver
{
    protected $telegram;

    public function __construct(Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function created(Model $model)
    {
        $this->notify($model);
    }

    protected function notify(Model $model)
    {
        $text = "💬 Сообщение в чат от {$model->user->publicName()}\n".htmlspecialchars_decode($model->text, ENT_QUOTES);

        $this->telegram->notifyAdmin($text);
    }
}
