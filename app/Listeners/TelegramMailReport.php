<?php

namespace App\Listeners;

use App\Events\MailReported;

class TelegramMailReport extends TelegramNotifier
{
    public function handle(MailReported $event)
    {
        $email = $event->email;

        $text = "Жалоба на письмо {$email->id} от {$email->to}";

        $this->telegram->notifyAdmin($text);
    }
}
