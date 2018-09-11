<?php namespace App\Observers;

use App\ChatMessage as Model;
use App\Events\ChatMessageCreated;

class ChatMessageObserver
{
    public function created(Model $model)
    {
        event(new ChatMessageCreated($model));
    }
}
