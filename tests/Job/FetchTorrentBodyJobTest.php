<?php namespace Tests\Job;

use App\Factory\TorrentFactory;
use App\Http\GuzzleClientFactory;
use App\Jobs\FetchTorrentBodyJob;
use App\Services\Rto;
use GuzzleHttp\Psr7\Response;
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

        $httpClientFactory = (new GuzzleClientFactory)->forTest([
            new Response(200, [],
                '<div class="post_body">' . $body . '<fieldset class="attach"><span class="attach_link"><a class="magnet-link" href="magnet:?xt=urn:btih:info_hash&tr=' . urlencode($announcer) . '"></a></span></fieldset></div>'),
        ]);

        $rto = new Rto($httpClientFactory);

        $job = new FetchTorrentBodyJob($torrent->rto_id);
        $job->handle($rto);

        $torrent->refresh();

        $this->assertSame($body, $torrent->html);
        $this->assertSame($announcer, $torrent->announcer);
    }
}
