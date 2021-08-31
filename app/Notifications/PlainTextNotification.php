<?php namespace App\Notifications;

use Illuminate\Notifications\Notification;

class PlainTextNotification extends Notification
{
    public function __construct(public string $text)
    {
    }

    public function via()
    {
        return ['database'];
    }

    public function toArray()
    {
        return [
            'text' => $this->text,
        ];
    }
}
