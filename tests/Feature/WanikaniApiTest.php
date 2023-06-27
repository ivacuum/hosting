<?php

namespace Tests\Feature;

use App\ExternalHttpRequest;
use App\Services\Wanikani\KanjiEntity;
use App\Services\Wanikani\SubjectResponse;
use App\Services\Wanikani\WanikaniApi;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WanikaniApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testNoCredentialsLogged()
    {
        \Http::fake([
            ...SubjectResponse::fakeKanji(555),
        ]);

        app(WanikaniApi::class)
            ->subject(555);

        $request = ExternalHttpRequest::latest('id')->first();

        $this->assertSame('Bearer WanikaniApiKey', $request->request_headers['Authorization'][0]);
    }

    public function testSubjectKanji()
    {
        \Http::fake([
            ...SubjectResponse::fakeKanji(555),
        ]);

        $response = $this->app
            ->make(WanikaniApi::class)
            ->subject(555);

        $this->assertInstanceOf(KanjiEntity::class, $response->subject);
    }
}
