<?php

namespace App\Domain\Wanikani\Api;

class WanikaniApiFake
{
    public static function subjectKanji(int $id): array
    {
        return [
            "api.wanikani.com/v2/subjects/{$id}" => SubjectResponse::fakeKanji($id),
        ];
    }
}
