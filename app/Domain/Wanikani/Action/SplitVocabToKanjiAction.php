<?php

namespace App\Domain\Wanikani\Action;

class SplitVocabToKanjiAction
{
    public function execute(string $vocab): array
    {
        return mb_str_split($this->onlyKanjiCharacters($vocab));
    }

    private function onlyKanjiCharacters(string $vocab): string
    {
        return preg_replace('/([ぁ-んァ-ン])/u', '', $vocab);
    }
}
