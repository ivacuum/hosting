<?php namespace App\Console\Commands;

use App\Kanji;
use App\Radical;
use App\Services\Wanikani;
use App\Vocabulary;
use Ivacuum\Generic\Commands\Command;

class ParseWanikani extends Command
{
    protected $signature = 'app:parse-wanikani {type=radicals} {min_level=1} {max_level=1} {timeout=1}';
    protected $description = 'Parse radicals, kanji or vocabulary from wanikani.com';

    public function handle(Wanikani $api)
    {
        $type = $this->argument('type');
        $timeout = (int) $this->argument('timeout');
        $min_level = max(1, min(60, $this->argument('min_level')));
        $max_level = max(1, min(60, $this->argument('max_level')));

        $data = [];

        if ($type === 'radicals') {
            foreach (range($min_level, $max_level) as $level) {
                $json = $api->radicals($level);

                foreach ($json->requested_information as $radical) {
                    $data[$radical->meaning] = $radical;
                }

                $this->info("Запрос {$level} уровня {$type}");

                if ($level > $min_level && $level < $max_level) {
                    sleep($timeout);
                }
            }

            foreach (Radical::whereIn('meaning', array_keys($data))->get(['id', 'meaning']) as $radical) {
                unset($data[$radical->meaning]);
            }

            foreach ($data as $radical) {
                Radical::forceCreate([
                    'image' => $radical->image ?? '',
                    'level' => $radical->level,
                    'meaning' => $radical->meaning,
                    'character' => $radical->character ?? '',
                ]);

                $this->info("New Radical: {$radical->meaning}");
            }
        } elseif ($type === 'kanji') {
            foreach (range($min_level, $max_level) as $level) {
                $json = $api->kanji($level);

                foreach ($json->requested_information as $kanji) {
                    $data[$kanji->character] = $kanji;
                }

                $this->info("Запрос {$level} уровня {$type}");

                if ($level > $min_level && $level < $max_level) {
                    sleep($timeout);
                }
            }

            foreach (Kanji::whereIn('character', array_keys($data))->get(['id', 'character']) as $kanji) {
                unset($data[$kanji->character]);
            }

            foreach ($data as $kanji) {
                $onyomi = $kanji->onyomi ?? '';
                $onyomi = $onyomi === 'None' ? '' : $onyomi;
                $kunyomi = $kanji->kunyomi ?? '';
                $kunyomi = $kunyomi === 'None' ? '' : $kunyomi;

                Kanji::forceCreate([
                    'level' => $kanji->level,
                    'nanori' => $kanji->nanori ?? '',
                    'onyomi' => $onyomi,
                    'meaning' => $kanji->meaning,
                    'kunyomi' => $kunyomi,
                    'character' => $kanji->character,
                    'important_reading' => $kanji->important_reading,
                ]);

                $this->info("New Kanji: {$kanji->character}");
            }
        } elseif ($type === 'vocabulary') {
            foreach (range($min_level, $max_level) as $level) {
                $json = $api->vocabulary($level);

                foreach ($json->requested_information as $vocab) {
                    $data[$vocab->character] = $vocab;
                }

                $this->info("Запрос {$level} уровня {$type}");

                if ($level > $min_level && $level < $max_level) {
                    sleep($timeout);
                }
            }

            foreach (Vocabulary::whereIn('character', array_keys($data))->get(['id', 'character']) as $vocab) {
                unset($data[$vocab->character]);
            }

            foreach ($data as $vocab) {
                Vocabulary::forceCreate([
                    'kana' => $vocab->kana,
                    'level' => $vocab->level,
                    'meaning' => $vocab->meaning,
                    'character' => $vocab->character,
                ]);

                $this->info("New Vocabulary: {$vocab->character}");
            }
        }
    }
}
