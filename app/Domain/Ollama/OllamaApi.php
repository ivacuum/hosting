<?php

namespace App\Domain\Ollama;

use App\Http\HttpPost;
use App\Http\HttpRequest;
use Illuminate\Http\Client\Factory;

class OllamaApi
{
    public function __construct(
        private Factory $http,
    ) {}

    public function chat(string $content, string $model = 'qwen3-vl')
    {
        $request = new OllamaChatRequest($model, [
            [
                'role' => 'user',
                'content' => $content,
            ],
        ]);

        return new OllamaChatResponse($this->sendRequest($request));
    }

    public function generate(string $prompt, array $images = [], string $model = 'qwen3-vl')
    {
        $request = new OllamaGenerateRequest($model, $prompt, $images);

        return new OllamaGenerateResponse($this->sendRequest($request));
    }

    private function configureClient()
    {
        return $this->http
            ->baseUrl('http://localhost:11434/api/')
            ->timeout(60)
            ->throw();
    }

    private function sendRequest(HttpRequest $request)
    {
        $http = $this->configureClient();

        $method = match (true) {
            $request instanceof HttpPost => $http->post(...),
            default => $http->get(...),
        };

        return $method($request->endpoint(), $request->jsonSerialize());
    }
}
