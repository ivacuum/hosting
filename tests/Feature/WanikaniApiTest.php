<?php namespace Tests\Feature;

use App\Services\Wanikani\KanjiEntity;
use App\Services\Wanikani\SubjectResponse;
use App\Services\Wanikani\WanikaniApi;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WanikaniApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testSubjectKanji()
    {
        \Http::preventStrayRequests()->fake([
            ...SubjectResponse::fakeKanji(555),
        ]);

        $response = $this->app
            ->make(WanikaniApi::class)
            ->subject(555);

        $this->assertInstanceOf(KanjiEntity::class, $response->subject);
    }
}
