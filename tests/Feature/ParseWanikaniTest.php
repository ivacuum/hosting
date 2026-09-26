<?php

namespace Tests\Feature;

use App\Console\Commands\ParseWanikani;
use App\Domain\Wanikani\Models\Kanji;
use App\Domain\Wanikani\Models\Radical;
use App\Domain\Wanikani\Models\Vocabulary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ParseWanikaniTest extends TestCase
{
    use DatabaseTransactions;

    public function testKanaVocabulary(): void
    {
        $this->fakeSubject(9177, 'kana_vocabulary', [
            'level' => 2,
            'characters' => 'おはよう',
            'meanings' => [
                ['accepted_answer' => true, 'meaning' => 'Good Morning'],
                ['accepted_answer' => true, 'meaning' => 'Morning'],
            ],
            'context_sentences' => [['en' => 'Good morning', 'ja' => 'おはよう']],
            'parts_of_speech' => ['expression'],
            'pronunciation_audios' => [
                [
                    'content_type' => 'audio/mpeg',
                    'metadata' => ['voice_actor_id' => 2, 'pronunciation' => 'おはよう'],
                    'url' => 'https://files.wanikani.com/morning-male',
                ],
                [
                    'content_type' => 'audio/mpeg',
                    'metadata' => ['voice_actor_id' => 1, 'pronunciation' => 'おはよう'],
                    'url' => 'https://files.wanikani.com/morning-female',
                ],
            ],
        ], level: 2);

        $this->artisan(ParseWanikani::class, ['min_level' => 2, 'max_level' => 2])->assertSuccessful();

        $vocab = Vocabulary::query()->where('wk_id', 9177)->sole();

        $this->assertSame(2, $vocab->level);
        $this->assertSame('おはよう', $vocab->character);
        $this->assertSame('good morning, morning', $vocab->meaning);
        $this->assertSame('おはよう', $vocab->kana);
        $this->assertSame("おはよう\nGood morning", $vocab->sentences);
        $this->assertSame('morning-female', $vocab->female_audio->slug);
        $this->assertSame('morning-male', $vocab->male_audio->slug);
    }

    public function testKanji(): void
    {
        $this->fakeSubject(452, 'kanji', [
            'level' => 13,
            'characters' => '口口口',
            'component_subject_ids' => [16],
            'visually_similar_subject_ids' => [],
            'meanings' => [['meaning' => 'Mouth-Mouth']],
            'readings' => [
                ['accepted_answer' => true, 'primary' => true, 'reading' => 'こう', 'type' => 'onyomi'],
                ['accepted_answer' => true, 'primary' => true, 'reading' => 'く', 'type' => 'onyomi'],
                ['accepted_answer' => false, 'primary' => false, 'reading' => 'くち', 'type' => 'kunyomi'],
            ],
        ]);

        $this->artisan(ParseWanikani::class)->assertSuccessful();

        $kanji = Kanji::query()->where('wk_id', 452)->sole();

        $this->assertSame(13, $kanji->level);
        $this->assertSame('口口口', $kanji->character);
        $this->assertSame('mouth-mouth', $kanji->meaning);
        $this->assertSame('こう, く', $kanji->onyomi);
        $this->assertSame('くち', $kanji->kunyomi);
        $this->assertSame('onyomi', $kanji->important_reading);
    }

    public function testRadical(): void
    {
        $this->fakeSubject(1, 'radical', [
            'level' => 12,
            'characters' => '一一一',
            'character_images' => [],
            'amalgamation_subject_ids' => [],
            'meanings' => [['meaning' => 'Ground-Ground']],
        ]);

        $this->artisan(ParseWanikani::class)->assertSuccessful();

        $radical = Radical::query()->where('wk_id', 1)->sole();

        $this->assertSame(12, $radical->level);
        $this->assertSame('一一一', $radical->character);
        $this->assertSame('ground-ground', $radical->meaning);
    }

    public function testVocabulary(): void
    {
        $this->fakeSubject(2484, 'vocabulary', $this->vocabularyData());

        $this->artisan(ParseWanikani::class)->assertSuccessful();

        $vocab = Vocabulary::query()->where('wk_id', 2484)->sole();

        $this->assertSame(14, $vocab->level);
        $this->assertSame('力力力', $vocab->character);
        $this->assertSame('power-power, strength-strength', $vocab->meaning);
        $this->assertSame('ちから', $vocab->kana);
        $this->assertSame("ますか\nEnglish", $vocab->sentences);
        $this->assertSame('female', $vocab->female_audio->slug);
        $this->assertSame('male', $vocab->male_audio->slug);
    }

    public function testVocabularyWithRightPronunciationAudio(): void
    {
        $data = $this->vocabularyData();
        array_unshift($data['pronunciation_audios'], [
            'content_type' => 'audio/mpeg',
            'metadata' => ['voice_actor_id' => 2, 'pronunciation' => 'ひとつ'],
            'url' => 'https://files.wanikani.com/wrong-pronunciation',
        ]);

        $this->fakeSubject(2484, 'vocabulary', $data);

        $this->artisan(ParseWanikani::class)->assertSuccessful();

        $vocab = Vocabulary::query()->where('wk_id', 2484)->sole();

        $this->assertSame('female', $vocab->female_audio->slug);
        $this->assertSame('male', $vocab->male_audio->slug);
    }

    private function fakeSubject(int $id, string $type, array $data, int $level = 1): void
    {
        \Http::fake([
            "api.wanikani.com/v2/subjects?hidden=false&levels={$level}" => \Http::response([
                'data' => [['id' => $id, 'object' => $type, 'data' => $data]],
            ]),
        ]);
    }

    private function vocabularyData(): array
    {
        return [
            'level' => 14,
            'characters' => '力力力',
            'meanings' => [
                ['accepted_answer' => true, 'meaning' => 'Power-Power'],
                ['accepted_answer' => true, 'meaning' => 'Strength-Strength'],
            ],
            'readings' => [['accepted_answer' => true, 'primary' => true, 'reading' => 'ちから']],
            'context_sentences' => [['en' => 'English', 'ja' => 'ますか']],
            'parts_of_speech' => ['noun'],
            'pronunciation_audios' => [
                [
                    'content_type' => 'audio/mpeg',
                    'metadata' => ['voice_actor_id' => 1, 'pronunciation' => 'ちから'],
                    'url' => 'https://files.wanikani.com/female',
                ],
                [
                    'content_type' => 'audio/mpeg',
                    'metadata' => ['voice_actor_id' => 2, 'pronunciation' => 'ちから'],
                    'url' => 'https://files.wanikani.com/male',
                ],
            ],
        ];
    }
}
