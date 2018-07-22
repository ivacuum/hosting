<?php namespace App\Observers;

use App\Issue as Model;
use Ivacuum\Generic\Services\Telegram;

class IssueObserver
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
        $text = "Обратная связь {$model->id} от {$model->email}\n{$model->title}\n".url($model->page)."\n\n".htmlspecialchars_decode($model->text, ENT_QUOTES);

        $this->telegram->notifyAdmin($text);
    }
}
