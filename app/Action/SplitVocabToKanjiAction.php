<?php

namespace App\Action;

class SplitVocabToKanjiAction
{
    public function execute(string $vocab): array
    {
        return str($this->onlyKanjiCharacters($vocab))
            ->split(1)
            ->all();
    }

    private function onlyKanjiCharacters(string $vocab): string
    {
        return preg_replace('/([ぁ-んァ-ン])/u', '', $vocab);
    }
}
