<?php namespace App\Console\Commands;

use App\Kanji;
use App\Radical;
use App\Services\Wanikani\WanikaniClient;
use App\Vocabulary;
use Ivacuum\Generic\Commands\Command;

class ParseWanikani extends Command
{
    protected $signature = 'app:parse-wanikani {min_level=1} {max_level=1} {sleep=1}';
    protected $description = 'Parse radicals, kanji or vocabulary from wanikani.com';

    public function handle(WanikaniClient $api)
    {
        $sleep = (int) $this->argument('sleep');
        $minLevel = max(1, min(60, $this->argument('min_level')));
        $maxLevel = max($minLevel, min(60, $this->argument('max_level')));

        foreach (range($minLevel, $maxLevel) as $level) {
            $this->info("Запрос {$level} уровня");

            $response = $api->subjects($level);

            foreach ($response->getRadicals() as $radical) {
                $model = Radical::firstWhere('wk_id', $radical->getId())
                    ?? Radical::firstWhere('meaning', $radical->getMeaning())
                    ?? new Radical;

                $model->image = '';
                $model->wk_id = $radical->getId();
                $model->level = $radical->getLevel();
                $model->meaning = $radical->getMeaning();
                $model->character = $radical->getCharacter();
                $model->save();

                if ($radical->getFoundInKanji()->isNotEmpty()) {
                    $ids = Kanji::query()
                        ->whereIn('wk_id', $radical->getFoundInKanji())
                        ->pluck('id');

                    $model->kanjis()->sync($ids);
                }
            }

            foreach ($response->getKanjis() as $kanji) {
                $model = Kanji::firstWhere('wk_id', $kanji->getId())
                    ?? Kanji::firstWhere('character', $kanji->getCharacter())
                    ?? new Kanji;

                $model->level = $kanji->getLevel();
                $model->wk_id = $kanji->getId();
                $model->nanori = $kanji->getNanori()->implode(', ');
                $model->onyomi = $kanji->getOnyomi()->implode(', ');
                $model->kunyomi = $kanji->getKunyomi()->implode(', ');
                $model->meaning = mb_strtolower($kanji->getMeanings()->implode(', '));
                $model->character = $kanji->getCharacter();
                $model->important_reading = $kanji->getImportantReading();
                $model->save();

                if ($kanji->getSimilarKanji()->isNotEmpty()) {
                    $ids = Kanji::query()
                        ->whereIn('wk_id', $kanji->getSimilarKanji())
                        ->pluck('id');

                    $model->similar()->sync($ids);
                }
            }

            foreach ($response->getVocabularies() as $vocab) {
                $model = Vocabulary::firstWhere('wk_id', $vocab->getId())
                    ?? Vocabulary::firstWhere('character', $vocab->getCharacters())
                    ?? new Vocabulary;

                $model->kana = mb_strtolower($vocab->getReadings()->implode(', '));
                $model->level = $vocab->getLevel();
                $model->wk_id = $vocab->getId();
                $model->meaning = mb_strtolower($vocab->getMeanings()->implode(', '));
                $model->character = $vocab->getCharacters();
                $model->sentences = $vocab->getSentences()->implode("\n\n");
                $model->male_audio_id = $vocab->getMaleAudioId();
                $model->female_audio_id = $vocab->getFemaleAudioId();
                $model->save();
            }

            if ($level > $minLevel && $level < $maxLevel) {
                sleep($sleep);
            }
        }
    }
}
