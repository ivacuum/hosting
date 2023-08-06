<?php

namespace App\Domain;

readonly class VocabularyAudio
{
    public function __construct(public string $slug)
    {
    }

    public function externalLink(): string
    {
        return "https://files.wanikani.com/{$this->slug}";
    }
}
