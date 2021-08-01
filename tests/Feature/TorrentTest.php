<?php namespace Tests\Feature;

use App\Factory\CommentFactory;
use App\Factory\TorrentFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\TorrentAddForm;
use App\Services\Rto;
use App\Services\RtoTopicData;
use App\Torrent;
use App\User;
use GuzzleHttp\Psr7\Response;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ivacuum\Generic\Http\GuzzleClientFactory;
use Ivacuum\Generic\Jobs\SendTelegramMessageJob;
use Tests\TestCase;

class TorrentTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoryFilter()
    {
        $categoryId = 2;
        $torrent = TorrentFactory::new()->withCategoryId($categoryId)->create();

        $this->get("torrents?category_id={$categoryId}")
            ->assertOk()
            ->assertSee($torrent->title);
    }

    public function testComments()
    {
        $comment = CommentFactory::new()->withTorrent()->create();

        $this->get('torrents/comments')
            ->assertOk()
            ->assertSee($comment->html);
    }

    public function testCreate()
    {
        $user = UserFactory::new()->withId(1)->make();

        $this->be($user)
            ->get('torrents/add')
            ->assertOk()
            ->assertSeeLivewire(TorrentAddForm::class);
    }

    public function testFaq()
    {
        $this->get('torrents/faq')
            ->assertOk();
    }

    public function testIndex()
    {
        $torrent = TorrentFactory::new()->create();

        $this->get('torrents')
            ->assertOk()
            ->assertSee($torrent->title);
    }

    public function testLivewireState()
    {
        $stub = TorrentFactory::new()->make();

        $this->swap(Rto::class, new Rto($this->httpClientFactory($stub)));

        \Livewire::test(TorrentAddForm::class)
            ->set('input', $stub->rto_id)
            ->assertSet('size', $stub->size)
            ->assertSet('title', $stub->title)
            ->assertSet('topicId', $stub->rto_id)
            ->set('categoryId', $stub->category_id);
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
            ->assertOk()
            ->assertSee($torrent->title);
    }

    public function testPromo()
    {
        $this->get('torrent')
            ->assertOk()
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

        \Queue::assertPushed(SendTelegramMessageJob::class);
    }

    public function testSearch()
    {
        $torrent = TorrentFactory::new()
            ->withTitle('title 20172017 something else')
            ->create();

        $this->get('torrents?q=20172017')
            ->assertOk()
            ->assertSee($torrent->title);
    }

    public function testShow()
    {
        $torrent = TorrentFactory::new()->create();

        $this->get("torrents/{$torrent->id}")
            ->assertOk()
            ->assertSee($torrent->title);
    }

    public function testStoreAsAnonymous()
    {
        $stub = TorrentFactory::new()->make();

        $this->swap(Rto::class, new Rto($this->httpClientFactory($stub)));

        $this->expectsEvents(\App\Events\Stats\TorrentAddedAnonymously::class);

        $livewire = \Livewire::test(TorrentAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id)
            ->call('submit')
            ->assertHasNoErrors();

        $user = User::find(config('cfg.torrent_anonymous_releaser'))
            ?? UserFactory::new()->withId(config('cfg.torrent_anonymous_releaser'))->create();

        /** @var Torrent $torrent */
        $torrent = $user->torrents()->latest('id')->first();

        $livewire->assertRedirect($torrent->www());

        $this->assertSame($stub->rto_id, $torrent->rto_id);
        $this->assertSame($stub->category_id, $torrent->category_id);
    }

    public function testStoreAsUser()
    {
        $stub = TorrentFactory::new()->make();
        $user = UserFactory::new()->create();

        $this->swap(Rto::class, new Rto($this->httpClientFactory($stub)));

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\TorrentAdded::class);

        $livewire = \Livewire::test(TorrentAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id)
            ->call('submit')
            ->assertHasNoErrors();

        $torrent = $user->torrents[0];

        $livewire->assertRedirect($torrent->www());

        $this->assertSame($stub->rto_id, $torrent->rto_id);
        $this->assertSame($stub->category_id, $torrent->category_id);
    }

    public function testStoreDuplicate()
    {
        $torrent = TorrentFactory::new()->create();
        $user = UserFactory::new()->create();

        $this->swap(Rto::class, new Rto($this->httpClientFactory($torrent)));

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\TorrentDuplicateFound::class);

        \Livewire::test(TorrentAddForm::class)
            ->set('input', $torrent->externalLink())
            ->assertHasErrors('input');

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
            new Response(200, [], json_encode([
                'result' => [
                    $stub->rto_id => (new RtoTopicData($stub->rto_id, $stub->title, $stub->info_hash, $stub->registered_at, RtoTopicData::STATUS_APPROVED, $stub->size, 3, 4, 5, now()))->toJson(),
                ],
            ])),
            new Response(200, [],
                '<div class="post_body">body<fieldset class="attach"><span class="attach_link"><a class="magnet-link" href="magnet:?xt=urn:btih:' . $stub->info_hash . '&tr=' . urlencode($stub->announcer) . '"></a></span></fieldset></div>'),
        ]);
    }
}
