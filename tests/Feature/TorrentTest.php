<?php namespace Tests\Feature;

use App\Action\FindRelatedMagnetsAction;
use App\Domain\RtoTopicStatus;
use App\Factory\CommentFactory;
use App\Factory\MagnetFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\TorrentAddForm;
use App\Magnet;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Ivacuum\Generic\Jobs\SendTelegramMessageJob;
use Mockery\MockInterface;
use Tests\TestCase;

class TorrentTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoryFilter()
    {
        $categoryId = 2;
        $magnet = MagnetFactory::new()->withCategoryId($categoryId)->create();

        $this->get("magnets?category_id={$categoryId}")
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testComments()
    {
        $comment = CommentFactory::new()->withMagnet()->create();

        $this->get('magnets/comments')
            ->assertOk()
            ->assertSee($comment->html);
    }

    public function testCreate()
    {
        $user = UserFactory::new()->withId(1)->make();

        $this->be($user)
            ->get('magnets/add')
            ->assertOk()
            ->assertSeeLivewire(TorrentAddForm::class);
    }

    public function testFaq()
    {
        $this->get('magnets/faq')
            ->assertOk();
    }

    public function testIndex()
    {
        $magnet = MagnetFactory::new()->create();

        $this->get('magnets')
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testLivewireState()
    {
        $stub = MagnetFactory::new()->make();

        $this->fakeHttpRequests($stub);

        \Livewire::test(TorrentAddForm::class)
            ->set('input', $stub->rto_id)
            ->assertSet('size', $stub->size)
            ->assertSet('title', $stub->title)
            ->assertSet('topicId', $stub->rto_id)
            ->set('categoryId', $stub->category_id);
    }

    public function testMagnetClick()
    {
        $magnet = MagnetFactory::new()->create();
        $clicks = $magnet->clicks;

        $this->post("magnets/{$magnet->id}/magnet")
            ->assertNoContent();

        $magnet->refresh();

        $this->assertSame($clicks + 1, $magnet->clicks);
    }

    public function testMy()
    {
        $magnet = MagnetFactory::new()->create();

        $this->be($magnet->user)
            ->get('magnets/my')
            ->assertOk()
            ->assertSee($magnet->title);
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
            ->from('magnets')
            ->post('magnets/request', ['query' => 'query'])
            ->assertRedirect('magnets')
            ->assertSessionHasNoErrors();

        \Queue::assertPushed(SendTelegramMessageJob::class);
    }

    public function testSearch()
    {
        $magnet = MagnetFactory::new()
            ->withTitle('title 20172017 something else')
            ->create();

        $this->get('magnets?q=20172017')
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testShow()
    {
        $magnet = MagnetFactory::new()->create();

        $this->get("magnets/{$magnet->id}")
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testShowWithRelated()
    {
        $magnet = MagnetFactory::new()->create();
        $related = MagnetFactory::new()->create();

        $this->mock(FindRelatedMagnetsAction::class, function (MockInterface $mock) use ($related) {
            $mock->shouldReceive('execute')->once()->andReturn([$related->id]);
        });

        $this->get("magnets/{$magnet->id}")
            ->assertOk()
            ->assertSee($magnet->title)
            ->assertSee($related->title);
    }

    public function testStoreAsAnonymous()
    {
        $stub = MagnetFactory::new()->make();

        $this->fakeHttpRequests($stub);

        $this->expectsEvents(\App\Events\Stats\TorrentAddedAnonymously::class);

        $livewire = \Livewire::test(TorrentAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id)
            ->call('submit')
            ->assertHasNoErrors();

        $user = User::find(config('cfg.torrent_anonymous_releaser'))
            ?? UserFactory::new()->withId(config('cfg.torrent_anonymous_releaser'))->create();

        /** @var Magnet $magnet */
        $magnet = $user->magnets()->latest('id')->first();

        $livewire->assertRedirect($magnet->www());

        $this->assertSame($stub->rto_id, $magnet->rto_id);
        $this->assertSame($stub->category_id, $magnet->category_id);
    }

    public function testStoreAsUser()
    {
        $stub = MagnetFactory::new()->make();
        $user = UserFactory::new()->create();

        $this->fakeHttpRequests($stub);

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\TorrentAdded::class);

        $livewire = \Livewire::test(TorrentAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id)
            ->call('submit')
            ->assertHasNoErrors();

        $magnet = $user->magnets[0];

        $livewire->assertRedirect($magnet->www());

        $this->assertSame($stub->rto_id, $magnet->rto_id);
        $this->assertSame($stub->category_id, $magnet->category_id);
    }

    public function testStoreDuplicate()
    {
        $magnet = MagnetFactory::new()->create();
        $user = UserFactory::new()->create();

        $this->fakeHttpRequests($magnet);

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\TorrentDuplicateFound::class);

        \Livewire::test(TorrentAddForm::class)
            ->set('input', $magnet->externalLink())
            ->assertHasErrors('input');

        $this->assertCount(0, $user->magnets);
    }

    private function fakeHttpRequests(Magnet $stub)
    {
        \Http::fake([
            "api.rutracker.org/v1/get_tor_topic_data?by=topic_id&val={$stub->rto_id}" => \Http::response([
                'result' => [
                    $stub->rto_id => [
                        'size' => $stub->size,
                        'seeders' => 5,
                        'forum_id' => 3,
                        'reg_time' => $stub->registered_at->getTimestamp(),
                        'info_hash' => $stub->info_hash,
                        'poster_id' => 4,
                        'tor_status' => RtoTopicStatus::Approved->value,
                        'topic_title' => $stub->title,
                        'seeder_last_seen' => now()->getTimestamp(),
                    ],
                ],
            ]),
            "rutracker.org/forum/viewtopic.php?t={$stub->rto_id}" => \Http::response('<div class="post_body">body<fieldset class="attach"><span class="attach_link"><a class="magnet-link" href="magnet:?xt=urn:btih:' . $stub->info_hash . '&tr=' . urlencode($stub->announcer) . '"></a></span></fieldset></div>'),
            '*' => \Http::response(),
        ]);
    }
}
