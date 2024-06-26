<?php

namespace Tests\Job;

use App\Factory\MagnetFactory;
use App\Jobs\FetchTorrentBodyJob;
use App\Services\Rto;
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

        $http = \Http::fake([
            'rutracker.org/forum/viewtopic.php?t=911' => \Http::response('<div class="post_body">' . $body . '<fieldset class="attach"><span class="attach_link"><a class="magnet-link" href="magnet:?xt=urn:btih:info_hash&tr=' . urlencode($announcer) . '"></a></span></fieldset></div>'),
        ]);

        $rto = new Rto($http);

        $job = new FetchTorrentBodyJob(911);
        $job->handle($rto);

        $magnet->refresh();

        $this->assertSame($body, $magnet->html);
        $this->assertSame($announcer, $magnet->announcer);
    }
}
