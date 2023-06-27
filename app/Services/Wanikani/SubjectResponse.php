<?php

namespace App\Services\Wanikani;

use Carbon\Carbon;
use Illuminate\Http\Client\Factory;
use Illuminate\Http\Client\Response;

class SubjectResponse
{
    public $json;
    public KanjiEntity|RadicalEntity|VocabularyEntity $subject;

    public function __construct(Response $response)
    {
        $this->json = $response->json();

        $this->subject = match ($response->json('object')) {
            'radical' => RadicalEntity::fromArray($response->json('id'), $response->json('data')),
            'kanji' => KanjiEntity::fromArray($response->json('id'), $response->json('data')),
            'vocabulary' => VocabularyEntity::fromArray($response->json('id'), $response->json('data')),
        };
    }

    public static function fakeKanji(int $id)
    {
        return [
            "api.wanikani.com/v2/subjects/{$id}" => Factory::response([
                'id' => $id,
                'object' => 'kanji',
                'url' => 'https://api.wanikani.com/v2/subjects/555',
                'data_updated_at' => Carbon::now()->toIso8601ZuluString(),
                'data' => [
                    'created_at' => Carbon::now()->toIso8601ZuluString(),
                    'level' => 4,
                    'slug' => '男',
                    'hidden_at' => null,
                    'document_url' => 'https://www.wanikani.com/kanji/%E7%94%B7',
                    'characters' => '男',
                    'meanings' => [
                        [
                            'meaning' => 'Man',
                            'primary' => true,
                            'accepted_answer' => true,
                        ],
                    ],
                    'auxiliary_meanings' => [],
                    'readings' => [
                        [
                            'type' => 'onyomi',
                            'primary' => true,
                            'reading' => 'だん',
                            'accepted_answer' => true,
                        ],
                    ],
                    'component_subject_ids' => [1, 2],
                    'amalgamation_subject_ids' => [3, 4],
                    'visually_similar_subject_ids' => [5],
                    'meaning_mnemonic' => '',
                    'meaning_hint' => '',
                    'reading_mnemonic' => '',
                    'reading_hint' => '',
                    'lesson_position' => 0,
                    'spaced_repetition_system_id' => 1,
                ],
            ]),
        ];
    }
}
