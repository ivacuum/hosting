<?php

namespace App\Console\Commands;

use App\Kanji;
use App\Radical;
use App\Services\Wanikani\WanikaniApi;
use App\Vocabulary;
use Illuminate\Support\Sleep;
use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:parse-wanikani')]
class ParseWanikani extends Command
{
    protected $signature = 'app:parse-wanikani {min_level=1} {max_level=1} {sleep=1}';
    protected $description = 'Parse radicals, kanji or vocabulary from wanikani.com';

    public function handle(WanikaniApi $wanikani)
    {
        $sleep = (int) $this->argument('sleep');
        $minLevel = max(1, min(60, $this->argument('min_level')));
        $maxLevel = max($minLevel, min(60, $this->argument('max_level')));

        foreach (range($minLevel, $maxLevel) as $level) {
            $this->info("Запрос {$level} уровня");

            $response = $wanikani->subjects($level);

            foreach ($response->getRadicals() as $radicalEntity) {
                $radical = Radical::query()->firstWhere('wk_id', $radicalEntity->id)
                    ?? Radical::query()->firstWhere('meaning', $radicalEntity->meaning)
                    ?? new Radical;

                $radical->image = '';
                $radical->wk_id = $radicalEntity->id;
                $radical->level = $radicalEntity->level;
                $radical->meaning = mb_strtolower($radicalEntity->meaning);
                $radical->character = $radicalEntity->character;
                $radical->save();

                if ($radicalEntity->foundInKanji->isNotEmpty()) {
                    $ids = Kanji::query()
                        ->whereIn('wk_id', $radicalEntity->foundInKanji)
                        ->pluck('id');

                    $radical->kanjis()->sync($ids);
                }
            }

            foreach ($response->getKanjis() as $kanjiEntity) {
                $kanji = Kanji::query()->firstWhere('wk_id', $kanjiEntity->id)
                    ?? Kanji::query()->firstWhere('character', $kanjiEntity->character)
                    ?? new Kanji;

                $kanji->level = $kanjiEntity->level;
                $kanji->wk_id = $kanjiEntity->id;
                $kanji->nanori = $kanjiEntity->getNanori()->implode(', ');
                $kanji->onyomi = $kanjiEntity->getOnyomi()->implode(', ');
                $kanji->kunyomi = $kanjiEntity->getKunyomi()->implode(', ');
                $kanji->meaning = mb_strtolower($kanjiEntity->meanings->implode(', '));
                $kanji->character = $kanjiEntity->character;
                $kanji->important_reading = $kanjiEntity->getImportantReading();
                $kanji->save();

                if ($kanjiEntity->similarKanji->isNotEmpty()) {
                    $ids = Kanji::query()
                        ->whereIn('wk_id', $kanjiEntity->similarKanji)
                        ->pluck('id');

                    $kanji->similar()->sync($ids);
                }
            }

            foreach ($response->getVocabularies() as $vocabEntity) {
                $vocab = Vocabulary::query()->firstWhere('wk_id', $vocabEntity->id)
                    ?? Vocabulary::query()->firstWhere('character', $vocabEntity->characters)
                    ?? new Vocabulary;

                $vocab->kana = mb_strtolower($vocabEntity->readings->implode(', '));
                $vocab->level = $vocabEntity->level;
                $vocab->wk_id = $vocabEntity->id;
                $vocab->meaning = mb_strtolower($vocabEntity->meanings->implode(', '));
                $vocab->character = $vocabEntity->characters;
                $vocab->sentences = $vocabEntity->getSentences()->implode("\n\n");
                $vocab->male_audio = $vocabEntity->maleAudio;
                $vocab->female_audio = $vocabEntity->femaleAudio;
                $vocab->save();
            }

            if ($level > $minLevel && $level < $maxLevel) {
                Sleep::for($sleep)->seconds();
            }
        }
    }
}
