<?php namespace App\Http\Controllers;

use App\Services\Telegram;

class Internal extends Controller
{
    public function ciBuildNotifier(Telegram $telegram)
    {
        $emoji = '';
        $number = $this->request->input('build.number');
        $status = strtolower($this->request->input('build.status'));
        $project = $this->request->input('name');
        $status_text = '';

        if ($status === 'success') {
            $emoji = "\xE2\x9C\x85 ";
        } else {
            $status_text = " [{$status}]";
        }

        $telegram->notifyAdmin("{$emoji}{$project} build {$number}{$status_text}");

        return 'ok';
    }

    public function telegramWebhook(Telegram $telegram)
    {
        \Log::info(json_encode($this->request->all()));
    }
}
