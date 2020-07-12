<?php namespace Tests\Feature;

use App\Factory\CommentFactory;
use App\Factory\TorrentFactory;
use App\Factory\UserFactory;
use App\Http\GuzzleClientFactory;
use App\Services\Rto;
use App\Services\RtoTopicData;
use App\Torrent;
use App\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TorrentTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoryFilter()
    {
        $categoryId = 2;
        $torrent = TorrentFactory::new()->withCategoryId($categoryId)->create();

        $this->get("torrents?category_id={$categoryId}")
            ->assertStatus(200)
            ->assertSee($torrent->title);
    }

    public function testComments()
    {
        $comment = CommentFactory::new()->withTorrent()->create();

        $this->get('torrents/comments')
            ->assertStatus(200)
            ->assertSee($comment->html);
    }

    public function testCreate()
    {
        $user = UserFactory::new()->withId(1)->make();

        $this->be($user)
            ->get('torrents/add')
            ->assertStatus(200);
    }

    public function testFaq()
    {
        $this->get('torrents/faq')
            ->assertStatus(200);
    }

    public function testIndex()
    {
        $torrent = TorrentFactory::new()->create();

        $this->get('torrents')
            ->assertStatus(200)
            ->assertSee($torrent->title);
    }

    public function testMagnetClick()
    {
        $torrent = TorrentFactory::new()->create();
        $clicks = $torrent->clicks;

        $this->post("torrents/{$torrent->id}/magnet")
            ->assertNoContent();

        $torrent->refresh();

        $this->assertSame($clicks + 1, $torrent->clicks);
    }

    public function testMy()
    {
        $torrent = TorrentFactory::new()->create();

        $this->be($torrent->user)
            ->get('torrents/my')
            ->assertStatus(200)
            ->assertSee($torrent->title);
    }

    public function testPromo()
    {
        $this->get('torrent')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }

    public function testRequestRelease()
    {
        \Queue::fake();

        $this
            ->from('torrents')
            ->post('torrents/request', ['query' => 'query'])
            ->assertRedirect('torrents')
            ->assertSessionHasNoErrors();
    }

    public function testSearch()
    {
        $torrent = TorrentFactory::new()->withTitle('title _2017_ something else')->create();

        $this->get('torrents?q=_2017_')
            ->assertStatus(200)
            ->assertSee($torrent->title);
    }

    public function testShow()
    {
        $torrent = TorrentFactory::new()->create();

        $this->get("torrents/{$torrent->id}")
            ->assertStatus(200)
            ->assertSee($torrent->title);
    }

    public function testStoreAsAnonymous()
    {
        $stub = TorrentFactory::new()->make();

        $this->swap(Rto::class, new Rto($this->httpClientFactory($stub)));

        $response = $this->post('torrents', ['input' => $stub->rto_id, 'category_id' => $stub->category_id]);

        $user = User::findOrFail(config('cfg.torrent_anonymous_releaser'));

        /** @var Torrent $torrent */
        $torrent = $user->torrents()->latest('id')->first();

        $response->assertRedirect($torrent->www());

        $this->assertEquals($stub->rto_id, $torrent->rto_id);
        $this->assertEquals($stub->category_id, $torrent->category_id);
    }

    public function testStoreAsUser()
    {
        $stub = TorrentFactory::new()->make();
        $user = UserFactory::new()->create();

        $this->swap(Rto::class, new Rto($this->httpClientFactory($stub)));

        $response = $this->be($user)
            ->post('torrents', ['input' => $stub->rto_id, 'category_id' => $stub->category_id])
            ->assertSessionHasNoErrors();

        $torrent = $user->torrents[0];

        $response->assertRedirect($torrent->www());

        $this->assertEquals($stub->rto_id, $torrent->rto_id);
        $this->assertEquals($stub->category_id, $torrent->category_id);
    }

    public function testStoreDuplicate()
    {
        $torrent = TorrentFactory::new()->create();
        $user = UserFactory::new()->create();

        $this->swap(Rto::class, new Rto($this->httpClientFactory($torrent)));

        $this->be($user)
            ->from('torrent/add')
            ->expectsEvents(\App\Events\Stats\TorrentDuplicateFound::class)
            ->post('torrents', ['input' => $torrent->rto_id, 'category_id' => $torrent->category_id])
            ->assertSessionHasNoErrors()
            ->assertSessionHas('message')
            ->assertRedirect('torrent/add');

        $this->assertCount(0, $user->torrents);
    }

    private function httpClientFactory(Torrent $stub)
    {
        return (new GuzzleClientFactory)->forTest([
            new Response(200, [], json_encode([
                'result' => [
                    $stub->rto_id => (new RtoTopicData($stub->rto_id, $stub->title, $stub->info_hash, $stub->registered_at, RtoTopicData::STATUS_APPROVED, $stub->size, 3, 4, 5, now()))->toJson(),
                ],
            ])),
            new Response(200, [],
                '<div class="post_body">body<fieldset class="attach"><span class="attach_link"><a href="magnet:?xt=urn:btih:' . $stub->info_hash . '&tr=' . urlencode($stub->announcer) . '"></a></span></fieldset></fieldset>'),
        ]);
    }
}
