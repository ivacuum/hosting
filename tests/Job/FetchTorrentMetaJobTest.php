<?php

namespace Tests\Job;

use App\Domain\MagnetStatus;
use App\Domain\RtoTopicStatus;
use App\Factory\MagnetFactory;
use App\Jobs\FetchTorrentBodyJob;
use App\Jobs\FetchTorrentMetaJob;
use App\Services\RtoTopicData;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ivacuum\Generic\Telegram\TelegramResponse;
use Tests\TestCase;

class FetchTorrentMetaJobTest extends TestCase
{
    use DatabaseTransactions;

    public function testBodyFetchQueued()
    {
        \Bus::fake();

        $infoHash = 'updated-info-hash';
        $magnet = MagnetFactory::new()->withRtoId(911)->create();

        $topicData = new RtoTopicData(
            911,
            $magnet->title,
            $infoHash,
            $magnet->registered_at,
            RtoTopicStatus::Approved,
            $magnet->size,
            3,
            4,
            5,
            now()
        );

        $this->fakeHttpClient($topicData);

        $job = new FetchTorrentMetaJob(911);
        $this->app->call($job->handle(...));

        $magnet->refresh();

        $this->assertSame($infoHash, $magnet->info_hash);

        \Bus::assertDispatched(FetchTorrentBodyJob::class);
    }

    public function testDuplicateDeleted()
    {
        $magnet = MagnetFactory::new()->withRtoId(911)->create();

        $topicData = new RtoTopicData(
            911,
            $magnet->title,
            $magnet->info_hash,
            $magnet->registered_at,
            RtoTopicStatus::Duplicate,
            $magnet->size,
            3,
            4,
            5,
            now()
        );

        $this->fakeHttpClient($topicData);

        \Event::fake(\App\Events\Stats\TorrentDuplicateDeleted::class);

        $job = new FetchTorrentMetaJob(911);
        $this->app->call($job->handle(...));

        $magnet->refresh();

        $this->assertSame(MagnetStatus::Deleted, $magnet->status);

        \Event::assertDispatched(\App\Events\Stats\TorrentDuplicateDeleted::class);
    }

    public function testMetaUpdated()
    {
        $size = 1234567890;
        $title = 'TITLE';
        $magnet = MagnetFactory::new()->withRtoId(911)->create();

        $topicData = new RtoTopicData(
            911,
            $title,
            $magnet->info_hash,
            $magnet->registered_at,
            RtoTopicStatus::Approved,
            $size,
            3,
            4,
            5,
            now()
        );

        $this->fakeHttpClient($topicData);

        $job = new FetchTorrentMetaJob(911);
        $this->app->call($job->handle(...));

        $magnet->refresh();

        $this->assertSame($size, $magnet->size);
        $this->assertSame($title, $magnet->title);
    }

    public function testNotFoundAndDeleted()
    {
        $magnet = MagnetFactory::new()->withRtoId(911)->create();

        \Http::fake([
            'api-rto.vacuum.name/v1/get_tor_topic_data?by=topic_id&val=911' => \Http::response([
                'result' => [
                    911 => null,
                ],
            ]),
            ...TelegramResponse::fakeSuccess(),
        ]);

        \Event::fake(\App\Events\Stats\TorrentNotFoundDeleted::class);

        $job = new FetchTorrentMetaJob(911);
        $this->app->call($job->handle(...));

        $magnet->refresh();

        $this->assertSame(MagnetStatus::Deleted, $magnet->status);

        \Event::assertDispatched(\App\Events\Stats\TorrentNotFoundDeleted::class);
    }

    public function testPremoderationLeavesTorrentMetaUntouched()
    {
        $magnet = MagnetFactory::new()->withRtoId(911)->create();

        $size = $magnet->size;
        $title = $magnet->title;

        $topicData = new RtoTopicData(
            911,
            'NEW TITLE',
            $magnet->info_hash,
            $magnet->registered_at,
            RtoTopicStatus::Premoderation,
            1234567890,
            3,
            4,
            5,
            now()
        );

        $this->fakeHttpClient($topicData);

        $job = new FetchTorrentMetaJob(911);
        $this->app->call($job->handle(...));

        $magnet->refresh();

        $this->assertSame($size, $magnet->size);
        $this->assertSame($title, $magnet->title);
    }

    private function fakeHttpClient(RtoTopicData $topicData)
    {
        \Http::fake([
            "api-rto.vacuum.name/v1/get_tor_topic_data?by=topic_id&val={$topicData->id}" => \Http::response([
                'result' => [
                    $topicData->id => $topicData->toJson(),
                ],
            ]),
            ...TelegramResponse::fakeSuccess(),
        ]);
    }
}
