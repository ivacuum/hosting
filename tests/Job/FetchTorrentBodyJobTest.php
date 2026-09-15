<?php

namespace Tests\Job;

use App\Domain\Magnet\Factory\MagnetFactory;
use App\Domain\Magnet\Job\FetchTorrentBodyJob;
use App\Domain\Rto\RtoFake;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FetchTorrentBodyJobTest extends TestCase
{
    use DatabaseTransactions;

    public function testOk()
    {
        $body = 'new body';
        $announcer = 'announcer';
        $magnet = MagnetFactory::new()->withRtoId(911)->create();

        \Http::fake(RtoFake::parseTopicBody(911, $body, $announcer));

        $job = new FetchTorrentBodyJob(911);
        $this->app->call($job->handle(...));

        $magnet->refresh();

        $this->assertSame($body, $magnet->html);
        $this->assertSame($announcer, $magnet->announcer);
    }
}
