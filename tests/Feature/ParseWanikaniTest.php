<?php namespace Tests\Feature;

use App\Console\Commands\ParseWanikani;
use App\Kanji;
use App\Radical;
use App\Vocabulary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ParseWanikaniTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk()
    {
        \Http::fake([
            'api.wanikani.com/v2/subjects?hidden=false&levels=1' => \Http::response([
                'data' => [
                    [
                        'data' => [
                            'amalgamation_subject_ids' => [1, 2, 3],
                            'auxiliary_meanings' => [],
                            'character_images' => [
                                [
                                    'content_type' => 'image/svg+xml',
                                    'metadata' => [
                                        'inline_styles' => false,
                                    ],
                                    'url' => 'https://cdn.wanikani.com/images/576-subject-1-without-css-original.svg?1520987227',
                                ],
                            ],
                            'characters' => '一一一',
                            'created_at' => '2012-02-27T18:08:16.000000Z',
                            'document_url' => 'https://www.wanikani.com/radicals/ground',
                            'hidden_at' => null,
                            'level' => 12,
                            'meaning_mnemonic' => '',
                            'meanings' => [
                                [
                                    'accepted_answer' => true,
                                    'meaning' => 'Ground-Ground',
                                    'primary' => true,
                                ],
                            ],
                            'slug' => 'ground',
                        ],
                        'id' => 1,
                        'object' => 'radical',
                        'url' => 'https://api.wanikani.com/v2/subjects/1',
                    ],
                    [
                        'data' => [
                            'amalgamation_subject_ids' => [1, 2, 3],
                            'auxiliary_meanings' => [],
                            'characters' => '口口口',
                            'component_subject_ids' => [16],
                            'created_at' => '2012-02-27T18:08:16.000000Z',
                            'document_url' => 'https://www.wanikani.com/kanji/%E5%8F%A3',
                            'hidden_at' => null,
                            'level' => 13,
                            'meaning_hint' => '',
                            'meaning_mnemonic' => '',
                            'meanings' => [
                                [
                                    'accepted_answer' => true,
                                    'meaning' => 'Mouth-Mouth',
                                    'primary' => true,
                                ],
                            ],
                            'reading_hint' => '',
                            'reading_mnemonic' => '',
                            'readings' => [
                                [
                                    'accepted_answer' => true,
                                    'primary' => true,
                                    'reading' => 'こう',
                                    'type' => 'onyomi',
                                ],
                                [
                                    'accepted_answer' => true,
                                    'primary' => true,
                                    'reading' => 'く',
                                    'type' => 'onyomi',
                                ],
                                [
                                    'accepted_answer' => false,
                                    'primary' => false,
                                    'reading' => 'くち',
                                    'type' => 'kunyomi',
                                ],
                            ],
                            'slug' => '口',
                            'visually_similar_subject_ids' => [],
                        ],
                        'id' => 452,
                        'object' => 'kanji',
                        'url' => 'https://api.wanikani.com/v2/subjects/452',
                    ],
                    [
                        'data' => [
                            'amalgamation_subject_ids' => [1, 2, 3],
                            'auxiliary_meanings' => [],
                            'characters' => '力力力',
                            'component_subject_ids' => [447],
                            'context_sentences' => [
                                [
                                    'en' => 'English',
                                    'ja' => 'ますか',
                                ],
                            ],
                            'created_at' => '2012-02-27T18:08:16.000000Z',
                            'document_url' => 'https://www.wanikani.com/kanji/%E5%8A%9B',
                            'hidden_at' => null,
                            'level' => 14,
                            'meaning_mnemonic' => '',
                            'meanings' => [
                                [
                                    'accepted_answer' => true,
                                    'meaning' => 'Power-Power',
                                    'primary' => true,
                                ],
                                [
                                    'accepted_answer' => true,
                                    'meaning' => 'Strength-Strength',
                                    'primary' => false,
                                ],
                            ],
                            'parts_of_speech' => ['noun'],
                            'pronunciation_audios' => [
                                [
                                    'content_type' => 'audio/mpeg',
                                    'metadata' => [
                                        'gender' => 'female',
                                        'pronunciation' => 'ちから',
                                        'source_id' => 21641,
                                        'voice_actor_id' => 1,
                                        'voice_actor_name' => 'Kyoko',
                                        'voice_description' => 'Tokyo accent',
                                    ],
                                    'url' => 'https://cdn.wanikani.com/audios/27982-subject-2484.mp3?1553788712',
                                ],
                                [
                                    'content_type' => 'audio/mpeg',
                                    'metadata' => [
                                        'gender' => 'male',
                                        'pronunciation' => 'ちから',
                                        'source_id' => 2726,
                                        'voice_actor_id' => 2,
                                        'voice_actor_name' => 'Kenichi',
                                        'voice_description' => 'Tokyo accent',
                                    ],
                                    'url' => 'https://cdn.wanikani.com/audios/3162-subject-2484.mp3?1547862380',
                                ],
                            ],
                            'reading_mnemonic' => '',
                            'readings' => [
                                [
                                    'accepted_answer' => true,
                                    'primary' => true,
                                    'reading' => 'ちから',
                                ],
                            ],
                            'slug' => '力',
                        ],
                        'id' => 2484,
                        'object' => 'vocabulary',
                        'url' => 'https://api.wanikani.com/v2/subjects/2484',
                    ],
                ],
                'object' => 'collection',
                'pages' => [
                    'next_url' => 'https://api.wanikani.com/v2/subjects?page_after_id=1000',
                    'per_page' => 1000,
                    'previous_url' => null,
                ],
                'total_count' => 9016,
                'url' => 'https://api.wanikani.com/v2/subjects',
            ]),
            '*' => \Http::response(),
        ]);

        $this->artisan(ParseWanikani::class);

        $radical = Radical::firstWhere('wk_id', 1);

        $this->assertSame(12, $radical->level);
        $this->assertSame('一一一', $radical->character);
        $this->assertSame('ground-ground', $radical->meaning);

        $kanji = Kanji::firstWhere('wk_id', 452);

        $this->assertSame(13, $kanji->level);
        $this->assertSame('口口口', $kanji->character);
        $this->assertSame('mouth-mouth', $kanji->meaning);
        $this->assertSame('こう, く', $kanji->onyomi);
        $this->assertSame('くち', $kanji->kunyomi);
        $this->assertSame('onyomi', $kanji->important_reading);

        $vocab = Vocabulary::firstWhere('wk_id', 2484);

        $this->assertSame(14, $vocab->level);
        $this->assertSame('力力力', $vocab->character);
        $this->assertSame('power-power, strength-strength', $vocab->meaning);
        $this->assertSame('ちから', $vocab->kana);
        $this->assertSame("ますか\nEnglish", $vocab->sentences);
        $this->assertSame(27982, $vocab->female_audio_id);
        $this->assertSame(3162, $vocab->male_audio_id);
    }
}
