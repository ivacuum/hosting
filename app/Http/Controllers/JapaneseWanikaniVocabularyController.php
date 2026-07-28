<?php

namespace App\Http\Controllers;

use App\Domain\Wanikani\Models\Vocabulary;
use App\Domain\Wanikani\Scope\UserBurnableScope;
use App\Http\Requests\WanikaniVocabIndexForm;

class JapaneseWanikaniVocabularyController
{
    public function index(WanikaniVocabIndexForm $request)
    {
        return view('japanese.wanikani.vocabularies', [
            'to' => $request->to,
            'from' => $request->from,
        ]);
    }

    public function show(string $characters)
    {
        $vocab = Vocabulary::query()
            ->where('character', $characters)
            ->tap(new UserBurnableScope(auth()->id()))
            ->sole();

        \Breadcrumbs::push(__('Уровень :level', ['level' => $vocab->level]), "japanese/wanikani/level/{$vocab->level}");
        \Breadcrumbs::push($vocab->character);

        return view('japanese.wanikani.vocabulary', [
            'vocab' => $vocab,
            'metaReplace' => ['vocab' => $vocab->character],
        ]);
    }
}
