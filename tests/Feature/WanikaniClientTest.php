<?php namespace Tests\Feature;

use App\Services\Wanikani\KanjiEntity;
use App\Services\Wanikani\SubjectResponse;
use App\Services\Wanikani\WanikaniClient;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WanikaniClientTest extends TestCase
{
    use DatabaseTransactions;

    public function testSubjectKanji()
    {
        \Http::preventStrayRequests()->fake([
            ...SubjectResponse::fakeKanji(555),
        ]);

        $wanikani = $this->app->make(WanikaniClient::class);
        $response = $wanikani->subject(555);

        $this->assertInstanceOf(KanjiEntity::class, $response->subject);
    }
}
