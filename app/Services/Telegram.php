<?php namespace App\Services;

use Telegram\Bot\Api;

class Telegram
{
    protected $telegram;

    public function __construct(Api $telegram)
    {
        $this->telegram = $telegram;
    }

    public function notifyAdmin($text)
    {
        if (\App::environment('local')) {
            $text = "\xF0\x9F\x9A\xA7 local\n{$text}";
        }

        $chat_id = config('cfg.telegram.admin_id');
        $disable_web_page_preview = true;

        event(new \App\Events\Stats\TelegramSent());

        register_shutdown_function(
            [$this->telegram, 'sendMessage'],
            compact('chat_id', 'text', 'disable_web_page_preview')
        );
    }

    public function notifyAdminProduction($text)
    {
        if (!\App::environment('production')) {
            return false;
        }

        $this->notifyAdmin($text);
    }
}
