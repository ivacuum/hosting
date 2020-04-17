<?php namespace App\Services\Wanikani;

use Illuminate\Support\Collection;

class VocabularyEntity
{
    private int $id;
    private int $level;
    private int $maleAudioId;
    private int $femaleAudioId;
    private string $characters;
    private Collection $meanings;
    private Collection $readings;
    private Collection $sentences;
    private Collection $partsOfSpeech;

    public function __construct(
        int $id,
        int $level,
        string $characters,
        Collection $meanings,
        Collection $readings,
        Collection $sentences,
        int $maleAudioId,
        int $femaleAudioId,
        Collection $partsOfSpeech
    ) {
        $this->id = $id;
        $this->level = $level;
        $this->meanings = $meanings;
        $this->readings = $readings;
        $this->sentences = $sentences;
        $this->characters = $characters;
        $this->maleAudioId = $maleAudioId;
        $this->femaleAudioId = $femaleAudioId;
        $this->partsOfSpeech = $partsOfSpeech;
    }

    public static function fromJson(int $id, object $json)
    {
        $audios = collect($json->pronunciation_audios);
        $maleAudioUrl = $audios->first(fn ($audio) => $audio->metadata->voice_actor_id === 2 && $audio->content_type === 'audio/mpeg')->url ?? '';
        $femaleAudioUrl = $audios->first(fn ($audio) => $audio->metadata->voice_actor_id === 1 && $audio->content_type === 'audio/mpeg')->url ?? '';

        return new self(
            $id,
            $json->level,
            $json->characters,
            collect($json->meanings)->filter(fn ($meaning) => $meaning->accepted_answer)->pluck('meaning'),
            collect($json->readings)->filter(fn ($reading) => $reading->accepted_answer)->pluck('reading'),
            collect($json->context_sentences),
            (int) \Str::of($maleAudioUrl)->after('/audios/')->before('-subject')->__toString(),
            (int) \Str::of($femaleAudioUrl)->after('/audios/')->before('-subject')->__toString(),
            collect($json->parts_of_speech),
        );
    }

    public function getCharacters()
    {
        return $this->characters;
    }

    public function getFemaleAudioId()
    {
        return $this->femaleAudioId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function getMaleAudioId()
    {
        return $this->maleAudioId;
    }

    public function getMeanings()
    {
        return $this->meanings;
    }

    public function getReadings()
    {
        return $this->readings;
    }

    public function getSentences()
    {
        return $this->sentences->map(fn ($sentence) => "{$sentence->ja}\n{$sentence->en}");
    }
}
