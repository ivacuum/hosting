<?php

namespace App\Domain\Ollama;

use App\Http\HttpPost;

readonly class OllamaGenerateRequest implements HttpPost
{
    public function __construct(
        private string $model,
        private string $prompt,
        private array $images = [],
        private array $jsonSchema = [],
        private int|null $temperature = null,
        private string|null $systemPrompt = null,
        private int|null $contextLength = 16384,
    ) {}

    #[\Override]
    public function endpoint(): string
    {
        return 'generate';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'model' => $this->model,
            'prompt' => $this->prompt,
            'think' => true,
            'stream' => false,
            'images' => $this->images,
            ...($this->jsonSchema ? ['format' => $this->jsonSchema] : []),
            'system' => $this->systemPrompt,
            'options' => [
                'num_ctx' => $this->contextLength,
                'temperature' => $this->temperature ?? 0,
            ],
        ];
    }
}
