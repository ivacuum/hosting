<?php

namespace Tests\Feature;

use App\Domain\Log\Models\ExternalHttpRequest;
use App\Domain\Wanikani\Api\KanjiEntity;
use App\Domain\Wanikani\Api\WanikaniApi;
use App\Domain\Wanikani\Api\WanikaniApiFake;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WanikaniApiTest extends TestCase
{
    use DatabaseTransactions;

    public function testNoCredentialsLogged(): void
    {
        Http::fake(WanikaniApiFake::subjectKanji(555));

        app(WanikaniApi::class)
            ->subject(555);

        $request = ExternalHttpRequest::query()->latest('id')->first();

        $this->assertSame('Bearer WanikaniApiKey', $request->request_headers['Authorization'][0]);
    }

    public function testSubjectKanji(): void
    {
        config(['services.wanikani.api_key' => 'secret-wanikani-token']);

        Http::fake(WanikaniApiFake::subjectKanji(555));

        $response = $this->app
            ->make(WanikaniApi::class)
            ->subject(555);

        $this->assertInstanceOf(KanjiEntity::class, $response->subject);
        $this->assertSame(555, $response->subject->id);
        $this->assertTrue($response->response->successful());
    }
}
