<?php

namespace App\Console\Commands;

use App\Kanji;
use App\Radical;
use App\Services\Wanikani\WanikaniApi;
use App\Vocabulary;
use Ivacuum\Generic\Commands\Command;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand('app:parse-wanikani', 'Parse radicals, kanji or vocabulary from wanikani.com')]
class ParseWanikani extends Command
{
    protected $signature = 'app:parse-wanikani {min_level=1} {max_level=1} {sleep=1}';

    public function handle(WanikaniApi $wanikani)
    {
        $sleep = (int) $this->argument('sleep');
        $minLevel = max(1, min(60, $this->argument('min_level')));
        $maxLevel = max($minLevel, min(60, $this->argument('max_level')));

        foreach (range($minLevel, $maxLevel) as $level) {
            $this->info("Запрос {$level} уровня");

            $response = $wanikani->subjects($level);

            foreach ($response->getRadicals() as $radical) {
                $model = Radical::query()->firstWhere('wk_id', $radical->id)
                    ?? Radical::query()->firstWhere('meaning', $radical->meaning)
                    ?? new Radical;

                $model->image = '';
                $model->wk_id = $radical->id;
                $model->level = $radical->level;
                $model->meaning = mb_strtolower($radical->meaning);
                $model->character = $radical->character;
                $model->save();

                if ($radical->foundInKanji->isNotEmpty()) {
                    $ids = Kanji::query()
                        ->whereIn('wk_id', $radical->foundInKanji)
                        ->pluck('id');

                    $model->kanjis()->sync($ids);
                }
            }

            foreach ($response->getKanjis() as $kanji) {
                $model = Kanji::query()->firstWhere('wk_id', $kanji->id)
                    ?? Kanji::query()->firstWhere('character', $kanji->character)
                    ?? new Kanji;

                $model->level = $kanji->level;
                $model->wk_id = $kanji->id;
                $model->nanori = $kanji->getNanori()->implode(', ');
                $model->onyomi = $kanji->getOnyomi()->implode(', ');
                $model->kunyomi = $kanji->getKunyomi()->implode(', ');
                $model->meaning = mb_strtolower($kanji->meanings->implode(', '));
                $model->character = $kanji->character;
                $model->important_reading = $kanji->getImportantReading();
                $model->save();

                if ($kanji->similarKanji->isNotEmpty()) {
                    $ids = Kanji::query()
                        ->whereIn('wk_id', $kanji->similarKanji)
                        ->pluck('id');

                    $model->similar()->sync($ids);
                }
            }

            foreach ($response->getVocabularies() as $vocab) {
                $model = Vocabulary::query()->firstWhere('wk_id', $vocab->id)
                    ?? Vocabulary::query()->firstWhere('character', $vocab->characters)
                    ?? new Vocabulary;

                $model->kana = mb_strtolower($vocab->readings->implode(', '));
                $model->level = $vocab->level;
                $model->wk_id = $vocab->id;
                $model->meaning = mb_strtolower($vocab->meanings->implode(', '));
                $model->character = $vocab->characters;
                $model->sentences = $vocab->getSentences()->implode("\n\n");
                $model->male_audio = $vocab->maleAudio;
                $model->female_audio = $vocab->femaleAudio;
                $model->save();
            }

            if ($level > $minLevel && $level < $maxLevel) {
                sleep($sleep);
            }
        }
    }
}
