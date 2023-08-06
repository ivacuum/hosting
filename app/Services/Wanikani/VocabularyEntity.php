<?php

namespace App\Services\Wanikani;

use Illuminate\Support\Collection;

class VocabularyEntity
{
    public function __construct(
        public int $id,
        public int $level,
        public string $characters,
        public Collection $meanings,
        public Collection $readings,
        private Collection $sentences,
        public string $maleAudio,
        public string $femaleAudio,
        public Collection $partsOfSpeech
    ) {
    }

    public static function fromArray(int $id, array $json, bool $isKanaVocabulary = false)
    {
        $primaryReading = $isKanaVocabulary
            ? $json['characters']
            : collect($json['readings'])->first(fn ($reading) => $reading['primary'])['reading'];

        $audios = collect($json['pronunciation_audios']);

        $maleAudioUrl = $audios->first(function ($audio) use ($primaryReading) {
            return $audio['metadata']['voice_actor_id'] === 2
                && $audio['content_type'] === 'audio/mpeg'
                && $audio['metadata']['pronunciation'] === $primaryReading;
        })['url'] ?? '';

        $femaleAudioUrl = $audios->first(function ($audio) use ($primaryReading) {
            return $audio['metadata']['voice_actor_id'] === 1
                && $audio['content_type'] === 'audio/mpeg'
                && $audio['metadata']['pronunciation'] === $primaryReading;
        })['url'] ?? '';

        return new self(
            $id,
            $json['level'],
            $json['characters'],
            collect($json['meanings'])
                ->filter(fn ($meaning) => $meaning['accepted_answer'])->pluck('meaning'),
            $isKanaVocabulary
                ? collect([$json['characters']])
                : collect($json['readings'])
                    ->filter(fn ($reading) => $reading['accepted_answer'])->pluck('reading'),
            collect($json['context_sentences']),
            str($maleAudioUrl)->after('wanikani.com/')->__toString(),
            str($femaleAudioUrl)->after('wanikani.com/')->__toString(),
            collect($json['parts_of_speech']),
        );
    }

    public function getSentences()
    {
        return $this->sentences->map(fn ($sentence) => "{$sentence['ja']}\n{$sentence['en']}");
    }
}
