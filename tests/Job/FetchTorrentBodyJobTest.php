<?php

namespace Tests\Job;

use App\Domain\Magnet\Factory\MagnetFactory;
use App\Domain\Magnet\Job\FetchTorrentBodyJob;
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

        \Http::fake([
            'rto.vacuum.name/forum/viewtopic.php?t=911' => \Http::response('<div class="post_body">' . $body . '<fieldset class="attach"><span class="attach_link"><a class="magnet-link" href="magnet:?xt=urn:btih:info_hash&tr=' . urlencode($announcer) . '"></a></span></fieldset></div>'),
        ]);

        $job = new FetchTorrentBodyJob(911);
        $this->app->call($job->handle(...));

        $magnet->refresh();

        $this->assertSame($body, $magnet->html);
        $this->assertSame($announcer, $magnet->announcer);
    }
}
