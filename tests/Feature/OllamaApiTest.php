<?php

namespace Tests\Feature;

use App\Domain\Ollama\OllamaApi;
use App\Domain\Ollama\OllamaChatResponse;
use App\Domain\Ollama\OllamaGenerateResponse;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class OllamaApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testChat()
    {
        \Http::fake([
            ...OllamaChatResponse::fakeSuccess(),
        ]);

        $response = $this->app
            ->make(OllamaApi::class)
            ->chat('What is in this video?');

        $this->assertTrue($response->successful);
        $this->assertSame('assistant', $response->role);
        $this->assertSame('Hello! How can I help you today?', $response->message);
    }

    public function testGenerate()
    {
        \Http::fake([
            ...OllamaGenerateResponse::fakeSuccess('12345'),
        ]);

        $response = $this->app
            ->make(OllamaApi::class)
            ->generate('What is in this video?');

        $this->assertTrue($response->successful);
        $this->assertSame('Here it goes...', $response->response);
    }
}
