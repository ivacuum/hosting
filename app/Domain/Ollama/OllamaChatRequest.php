<?php

namespace App\Domain\Ollama;

use App\Http\HttpPost;

readonly class OllamaChatRequest implements HttpPost
{
    public function __construct(
        private string $model,
        private array $messages,
    ) {}

    #[\Override]
    public function endpoint(): string
    {
        return 'chat';
    }

    #[\Override]
    public function jsonSerialize(): array
    {
        return [
            'model' => $this->model,
            'messages' => $this->messages,
            // 'think' => true,
            'stream' => false,
        ];
    }
}
