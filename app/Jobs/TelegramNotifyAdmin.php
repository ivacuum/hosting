<?php namespace App\Jobs;

class TelegramNotifyAdmin extends Base
{
    protected $telegram;

    public function __construct(\Ivacuum\Generic\Services\Telegram $telegram)
    {
        $this->telegram = $telegram;
    }

    public function handle()
    {
        \Log::info('My job was called! Failing then with an exception 2.');

        sleep(2);

        \Log::info('second log');

//        return false;

        throw new \Exception('Failing the job');
    }
}
