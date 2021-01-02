<?php namespace App\Notifications;

use Illuminate\Notifications\Notification;

class PlainTextNotification extends Notification
{
    public $text;

    public function __construct(string $text)
    {
        $this->text = $text;
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
