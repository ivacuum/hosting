<?php namespace Tests\Job;

use App\Factory\TorrentFactory;
use App\Jobs\FetchTorrentBodyJob;
use App\Jobs\FetchTorrentMetaJob;
use App\Services\RtoTopicData;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\Factory;
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

        $this->swap(Factory::class, $this->fakeHttpClient($topicData));

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $this->app->call([$job, 'handle']);

        $torrent->refresh();

        $this->assertSame($infoHash, $torrent->info_hash);

        \Bus::assertDispatched(FetchTorrentBodyJob::class);
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

        $this->swap(Factory::class, $this->fakeHttpClient($topicData));

        $this->expectsEvents(\App\Events\Stats\TorrentDuplicateDeleted::class);

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $this->app->call([$job, 'handle']);

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

        $this->swap(Factory::class, $this->fakeHttpClient($topicData));

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $this->app->call([$job, 'handle']);

        $torrent->refresh();

        $this->assertSame($size, $torrent->size);
        $this->assertSame($title, $torrent->title);
    }

    public function testNotFoundAndDeleted()
    {
        $torrent = TorrentFactory::new()->create();

        $this->swap(Factory::class, \Http::fake([
            "api.rutracker.org/v1/get_tor_topic_data?by=topic_id&val={$torrent->rto_id}" => \Http::response([
                'result' => [
                    $torrent->rto_id => null,
                ],
            ]),
            '*' => \Http::response(),
        ]));

        $this->expectsEvents(\App\Events\Stats\TorrentNotFoundDeleted::class);

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $this->app->call([$job, 'handle']);

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

        $this->swap(Factory::class, $this->fakeHttpClient($topicData));

        $job = new FetchTorrentMetaJob($torrent->rto_id);
        $this->app->call([$job, 'handle']);

        $torrent->refresh();

        $this->assertSame($size, $torrent->size);
        $this->assertSame($title, $torrent->title);
    }

    private function fakeHttpClient(RtoTopicData $topicData)
    {
        return \Http::fake([
            "api.rutracker.org/v1/get_tor_topic_data?by=topic_id&val={$topicData->id}" => \Http::response([
                'result' => [
                    $topicData->id => $topicData->toJson(),
                ],
            ]),
            '*' => \Http::response(),
        ]);
    }
}
