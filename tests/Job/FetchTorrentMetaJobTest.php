<?php

namespace Tests\Job;

use App\Domain\Magnet\Factory\MagnetFactory;
use App\Domain\Magnet\Job\FetchTorrentBodyJob;
use App\Domain\Magnet\Job\FetchTorrentMetaJob;
use App\Domain\Magnet\MagnetStatus;
use App\Domain\Rto\RtoApiException;
use App\Domain\Rto\RtoFake;
use App\Domain\Rto\RtoTopicData;
use App\Domain\Rto\RtoTopicStatus;
use App\Domain\Telegram\Api\TelegramResponse;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Exceptions;
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
            ...RtoFake::topicDataByIdsNotFound(911),
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

    public function testTemporarilyUnavailableApiSkipsRefreshWithoutReportingEachBatch(): void
    {
        \Bus::fake();
        \Notification::fake();
        Exceptions::fake();

        $firstMagnet = MagnetFactory::new()->withRtoId(911)->create()->refresh();
        $secondMagnet = MagnetFactory::new()->withRtoId(912)->create()->refresh();
        $firstAttributes = $firstMagnet->getAttributes();
        $secondAttributes = $secondMagnet->getAttributes();

        \Http::fake(RtoFake::topicDataByIdsTemporarilyUnavailable(911));

        $this->app->call(new FetchTorrentMetaJob(911)->handle(...));
        $this->app->call(new FetchTorrentMetaJob(912)->handle(...));

        $this->assertSame($firstAttributes, $firstMagnet->fresh()->getAttributes());
        $this->assertSame($secondAttributes, $secondMagnet->fresh()->getAttributes());

        \Http::assertSentCount(1);
        \Bus::assertNothingDispatched();
        \Notification::assertNothingSent();
        Exceptions::assertNothingReported();
    }

    public function testUnexpectedApiErrorIsNotSwallowed(): void
    {
        \Http::fake(RtoFake::topicDataByIdsTooManyTopics());

        $this->expectException(RtoApiException::class);
        $this->expectExceptionMessageIs('Param [val] is over the limit of 50 (you sent 100 values)');

        $this->app->call(new FetchTorrentMetaJob(...range(1, 100))->handle(...));
    }

    private function fakeHttpClient(RtoTopicData $topicData)
    {
        \Http::fake([
            ...RtoFake::topicDataByIds($topicData),
            ...TelegramResponse::fakeSuccess(),
        ]);
    }
}
