<?php namespace Tests\Job;

use App\Factory\TorrentFactory;
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
        $torrent = TorrentFactory::new()->create();

        $http = \Http::fake([
            "rutracker.org/forum/viewtopic.php?t={$torrent->rto_id}" =>
                \Http::response('<div class="post_body">' . $body . '<fieldset class="attach"><span class="attach_link"><a class="magnet-link" href="magnet:?xt=urn:btih:info_hash&tr=' . urlencode($announcer) . '"></a></span></fieldset></div>'),
            '*' => \Http::response(),
        ]);

        $rto = new Rto($http);

        $job = new FetchTorrentBodyJob($torrent->rto_id);
        $job->handle($rto);

        $torrent->refresh();

        $this->assertSame($body, $torrent->html);
        $this->assertSame($announcer, $torrent->announcer);
    }
}
