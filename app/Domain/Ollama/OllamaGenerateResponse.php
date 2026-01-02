<?php

namespace App\Domain\Ollama;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterval;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

readonly class OllamaGenerateResponse
{
    public bool $successful;
    public int|null $inputTokens;
    public int|null $outputTokens;
    public string|null $model;
    public string|null $response;
    public string|null $thinking;
    public CarbonInterval|null $evalDuration;
    public CarbonInterval|null $loadDuration;
    public CarbonInterval|null $totalDuration;
    public CarbonImmutable|null $createdAt;

    public function __construct(Response $response)
    {
        $this->successful = $response->json('error') === null;

        $this->model = $response->json('model');
        $this->response = $response->json('response');
        $this->thinking = $response->json('thinking');
        $this->createdAt = CarbonImmutable::make($response->json('created_at'));
        $this->inputTokens = $response->json('prompt_eval_count');
        $this->evalDuration = CarbonInterval::microseconds($response->json('eval_duration') / 1000)->cascade();
        $this->loadDuration = CarbonInterval::microseconds($response->json('load_duration') / 1000)->cascade();
        $this->outputTokens = $response->json('eval_count');
        $this->totalDuration = CarbonInterval::microseconds($response->json('total_duration') / 1000)->cascade();
    }

    public static function fakeError()
    {
        return [
            'localhost:11434/api/generate' => Factory::response([
                'error' => 'Something went wrong',
            ]),
        ];
    }

    public static function fakeSuccess(string $id = '1234567890')
    {
        return [
            'localhost:11434/api/generate' => Factory::response([
                'model' => 'qwen3-vl',
                'created_at' => '2025-10-17T23:14:07.414671Z',
                'response' => 'Here it goes...',
                'done' => true,
                'done_reason' => 'stop',
                'total_duration' => 174560334,
                'load_duration' => 101397084,
                'prompt_eval_count' => 11,
                'prompt_eval_duration' => 13074791,
                'eval_count' => 18,
                'eval_duration' => 52479709,
            ]),
        ];
    }
}
