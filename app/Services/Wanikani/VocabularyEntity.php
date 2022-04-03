<?php namespace App\Services\Wanikani;

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
        public int $maleAudioId,
        public int $femaleAudioId,
        private Collection $partsOfSpeech
    ) {
    }

    public static function fromArray(int $id, array $json)
    {
        $audios = collect($json['pronunciation_audios']);
        $maleAudioUrl = $audios->first(fn ($audio) => $audio['metadata']['voice_actor_id'] === 2 && $audio['content_type'] === 'audio/mpeg')['url'] ?? '';
        $femaleAudioUrl = $audios->first(fn ($audio) => $audio['metadata']['voice_actor_id'] === 1 && $audio['content_type'] === 'audio/mpeg')['url'] ?? '';

        return new self(
            $id,
            $json['level'],
            $json['characters'],
            collect($json['meanings'])->filter(fn ($meaning) => $meaning['accepted_answer'])->pluck('meaning'),
            collect($json['readings'])->filter(fn ($reading) => $reading['accepted_answer'])->pluck('reading'),
            collect($json['context_sentences']),
            (int) str($maleAudioUrl)->after('/audios/')->before('-subject')->__toString(),
            (int) str($femaleAudioUrl)->after('/audios/')->before('-subject')->__toString(),
            collect($json['parts_of_speech']),
        );
    }

    public function getSentences()
    {
        return $this->sentences->map(fn ($sentence) => "{$sentence['ja']}\n{$sentence['en']}");
    }
}
