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
                    $radical->image = $radical->image ?? '';
                    $radical->meaning = str_replace('-', ' ', $radical->meaning);
                    $radical->character = $radical->character ?? '';

                    $data[$radical->meaning] = $radical;
                }

                $this->info("Запрос {$level} уровня {$type}");

                if ($level > $min_level && $level < $max_level) {
                    sleep($timeout);
                }
            }

            foreach (Radical::whereIn('meaning', array_keys($data))->get(['id', 'level', 'character', 'meaning', 'image']) as $radical) {
                /* @var Radical $radical */
                $row = $data[$radical->meaning];

                $radical->timestamps = false;
                $radical->image = $row->image;
                $radical->level = $row->level;
                $radical->meaning = $row->meaning;
                $radical->character = $row->character;

                if ($radical->isDirty()) {
                    $this->info("Updated Radical: {$radical->meaning}");

                    foreach ($radical->getDirty() as $field => $value) {
                        $this->info("{$field}: {$radical->getOriginal($field)} => {$value}");
                    }
                }

                $radical->save();

                unset($data[$radical->meaning]);
            }

            foreach ($data as $radical) {
                Radical::forceCreate([
                    'image' => $radical->image,
                    'level' => $radical->level,
                    'meaning' => $radical->meaning,
                    'character' => $radical->character,
                ]);

                $this->info("New Radical: {$radical->meaning}");
            }
        } elseif ($type === 'kanji') {
            foreach (range($min_level, $max_level) as $level) {
                $json = $api->kanji($level);

                foreach ($json->requested_information as $kanji) {
                    $kanji->onyomi = $kanji->onyomi ?? '';
                    $kanji->onyomi = $kanji->onyomi === 'None' ? '' : $kanji->onyomi;
                    $kanji->nanori = $kanji->nanori ?? '';
                    $kanji->kunyomi = $kanji->kunyomi ?? '';
                    $kanji->kunyomi = $kanji->kunyomi === 'None' ? '' : $kanji->kunyomi;

                    $data[$kanji->character] = $kanji;
                }

                $this->info("Запрос {$level} уровня {$type}");

                if ($level > $min_level && $level < $max_level) {
                    sleep($timeout);
                }
            }

            foreach (Kanji::whereIn('character', array_keys($data))->get(['id', 'level', 'character', 'meaning', 'onyomi', 'kunyomi', 'important_reading', 'nanori']) as $kanji) {
                /* @var Kanji $kanji */
                $row = $data[$kanji->character];

                $kanji->timestamps = false;
                $kanji->level = $row->level;
                $kanji->nanori = $row->nanori;
                $kanji->onyomi = $row->onyomi;
                $kanji->meaning = $row->meaning;
                $kanji->kunyomi = $row->kunyomi;
                $kanji->character = $row->character;
                $kanji->important_reading = $row->important_reading;

                if ($kanji->isDirty()) {
                    $this->info("Updated Kanji: {$kanji->character}");

                    foreach ($kanji->getDirty() as $field => $value) {
                        $this->info("{$field}: {$kanji->getOriginal($field)} => {$value}");
                    }
                }

                $kanji->save();

                unset($data[$kanji->character]);
            }

            foreach ($data as $kanji) {
                Kanji::forceCreate([
                    'level' => $kanji->level,
                    'nanori' => $kanji->nanori,
                    'onyomi' => $kanji->onyomi,
                    'meaning' => $kanji->meaning,
                    'kunyomi' => $kanji->kunyomi,
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

            foreach (Vocabulary::whereIn('character', array_keys($data))->get(['id', 'level', 'character', 'meaning', 'kana']) as $vocab) {
                /* @var Vocabulary $vocab */
                $row = $data[$vocab->character];

                $vocab->timestamps = false;
                $vocab->kana = $row->kana;
                $vocab->level = $row->level;
                $vocab->meaning = $row->meaning;
                $vocab->character = $row->character;

                if ($vocab->isDirty()) {
                    $this->info("Updated Vocabulary: {$vocab->character}");

                    foreach ($vocab->getDirty() as $field => $value) {
                        $this->info("{$field}: {$vocab->getOriginal($field)} => {$value}");
                    }
                }

                $vocab->save();

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
