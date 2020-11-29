<?php namespace Tests\Job;

use App\Factory\TorrentFactory;
use App\Jobs\FetchTorrentMetaJob;
use App\Services\Rto;
use App\Services\RtoTopicData;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ivacuum\Generic\Http\GuzzleClientFactory;
use Ivacuum\Generic\Services\Telegram;
use Tests\TestCase;

class FetchTorrentMetaJobTest extends TestCase
{
    use DatabaseTransactions;

    public function testBodyFetchQueued()
    {
        \Bus::fake();

        $infoHash = 'updated-info-hash';
        $torrent = TorrentFactory::new()->create();

        $topicData = new RtoTopicData(
            $torrent->rto_id,
            $torrent->title,
            $infoHash,
            $torrent->registered_at,
            RtoTopicData::STATUS_APPROVED,
            $torrent->size,
            3,
            4,
            5,
            now()
        );

        $rto = new Rto($this->httpClientFactory($topicData));
        $telegram = \Mockery::mock(Telegram::class);
        $telegram->shouldReceive('notifyAdmin');

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $job->handle($rto, $telegram);

        $torrent->refresh();

        $this->assertSame($infoHash, $torrent->info_hash);
    }

    public function testDuplicateDeleted()
    {
        $torrent = TorrentFactory::new()->create();

        $topicData = new RtoTopicData(
            $torrent->rto_id,
            $torrent->title,
            $torrent->info_hash,
            $torrent->registered_at,
            RtoTopicData::STATUS_DUPLICATE,
            $torrent->size,
            3,
            4,
            5,
            now()
        );

        $rto = new Rto($this->httpClientFactory($topicData));
        $telegram = \Mockery::mock(Telegram::class);
        $telegram->shouldReceive('notifyAdmin');

        $this->expectsEvents(\App\Events\Stats\TorrentDuplicateDeleted::class);

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $job->handle($rto, $telegram);

        $torrent->refresh();

        $this->assertTrue($torrent->trashed());
    }

    public function testMetaUpdated()
    {
        $size = 1234567890;
        $title = 'TITLE';
        $torrent = TorrentFactory::new()->create();

        $topicData = new RtoTopicData(
            $torrent->rto_id,
            $title,
            $torrent->info_hash,
            $torrent->registered_at,
            RtoTopicData::STATUS_APPROVED,
            $size,
            3,
            4,
            5,
            now()
        );

        $rto = new Rto($this->httpClientFactory($topicData));
        $telegram = \Mockery::mock(Telegram::class);

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $job->handle($rto, $telegram);

        $torrent->refresh();

        $this->assertSame($size, $torrent->size);
        $this->assertSame($title, $torrent->title);
    }

    public function testNotFoundAndDeleted()
    {
        $torrent = TorrentFactory::new()->create();

        $httpClientFactory = (new GuzzleClientFactory)->forTest([
            new Response(200, [], json_encode([
                'result' => [
                    $torrent->rto_id => null,
                ],
            ])),
        ]);

        $rto = new Rto($httpClientFactory);
        $telegram = \Mockery::mock(Telegram::class);
        $telegram->shouldReceive('notifyAdmin');

        $this->expectsEvents(\App\Events\Stats\TorrentNotFoundDeleted::class);

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $job->handle($rto, $telegram);

        $torrent->refresh();

        $this->assertTrue($torrent->trashed());
    }

    public function testPremoderationLeavesTorrentMetaUntouched()
    {
        $torrent = TorrentFactory::new()->create();

        $size = $torrent->size;
        $title = $torrent->title;

        $topicData = new RtoTopicData(
            $torrent->rto_id,
            'NEW TITLE',
            $torrent->info_hash,
            $torrent->registered_at,
            RtoTopicData::STATUS_PREMODERATION,
            1234567890,
            3,
            4,
            5,
            now()
        );

        $rto = new Rto($this->httpClientFactory($topicData));
        $telegram = \Mockery::mock(Telegram::class);
        $telegram->shouldReceive('notifyAdmin');

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $job->handle($rto, $telegram);

        $torrent->refresh();

        $this->assertSame($size, $torrent->size);
        $this->assertSame($title, $torrent->title);
    }

    private function httpClientFactory(RtoTopicData $topicData)
    {
        return (new GuzzleClientFactory)->forTest([
            new Response(200, [], json_encode([
                'result' => [
                    $topicData->id => $topicData->toJson(),
                ],
            ])),
        ]);
    }
}
