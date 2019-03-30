<?php namespace App\Services;

use App\Http\GuzzleClientFactory;

class Wanikani
{
    protected $client;

    public function __construct()
    {
        $this->client = (new GuzzleClientFactory)
            ->baseUri('https://www.wanikani.com/api/user/'.config('cfg.wanikani_api_key').'/')
            ->timeout(10)
            ->createForService('wanikani');
    }

    public function kanji(int $level)
    {
        $level = $this->sanitizeLevel($level);

        $response = $this->client->get("kanji/{$level}");

        return json_decode($response->getBody());
    }

    public function radicals(int $level)
    {
        $level = $this->sanitizeLevel($level);

        $response = $this->client->get("radicals/{$level}");

        return json_decode($response->getBody());
    }

    public function studyQueue()
    {
        $response = $this->client->get('study-queue');

        return json_decode($response->getBody());
    }

    public function vocabulary(int $level)
    {
        $level = $this->sanitizeLevel($level);

        $response = $this->client->get("vocabulary/{$level}");

        return json_decode($response->getBody());
    }

    protected function sanitizeLevel(int $level): int
    {
        // Всего 60 уровней
        return max(1, min(60, $level));
    }
}
