<?php

namespace Tests\Feature;

use App\Action\FindRelatedMagnetsAction;
use App\Domain\Config;
use App\Domain\MagnetCategory;
use App\Domain\RtoTopicStatus;
use App\Factory\CommentFactory;
use App\Factory\MagnetFactory;
use App\Factory\UserFactory;
use App\Livewire\MagnetAddForm;
use App\Magnet;
use App\Notifications\AnonymousMagnetNotification;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Sleep;
use Ivacuum\Generic\Jobs\SendTelegramMessageJob;
use Tests\TestCase;

class MagnetTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoryFilter()
    {
        $category = MagnetCategory::ForeignCinema;
        $magnet = MagnetFactory::new()->withCategory($category)->create();

        $this->get("magnets?category_id={$category->value}")
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
            ->assertSeeLivewire(MagnetAddForm::class);
    }

    public function testFaq()
    {
        $this->get('magnets/faq')
            ->assertOk();
    }

    public function testIndexAsGuest()
    {
        $magnet = MagnetFactory::new()->create();

        $this->get('magnets')
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testIndexAsUser()
    {
        $this->be(UserFactory::new()->withId(1)->make())
            ->get('magnets')
            ->assertOk();
    }

    public function testLivewireState()
    {
        $stub = MagnetFactory::new()->make();

        $this->fakeHttpRequests($stub);

        \Livewire::test(MagnetAddForm::class)
            ->set('input', $stub->rto_id)
            ->assertSet('size', $stub->size)
            ->assertSet('title', $stub->title)
            ->assertSet('topicId', $stub->rto_id)
            ->set('categoryId', $stub->category_id->value);
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

    public function testShowDeleted()
    {
        $magnet = MagnetFactory::new()->deleted()->create();

        $this->get("magnets/{$magnet->id}")
            ->assertNotFound();
    }

    public function testShowHidden()
    {
        $magnet = MagnetFactory::new()->hidden()->create();

        $this->get("magnets/{$magnet->id}")
            ->assertNotFound();
    }

    public function testShowWithRelated()
    {
        $magnet = MagnetFactory::new()->create();
        $related = MagnetFactory::new()->create();

        $this->mock(FindRelatedMagnetsAction::class)
            ->expects('execute')
            ->andReturn([$related->id]);

        $this->get("magnets/{$magnet->id}")
            ->assertOk()
            ->assertSee($magnet->title)
            ->assertSee($related->title);
    }

    public function testStoreAsAnonymous()
    {
        \Notification::fake();

        $stub = MagnetFactory::new()->make();

        $this->fakeHttpRequests($stub);

        \Event::fake(\App\Events\Stats\TorrentAddedAnonymously::class);

        $livewire = \Livewire::test(MagnetAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id->value)
            ->call('submit')
            ->assertHasNoErrors();

        $user = User::query()->find(Config::MagnetAnonymousReleaser->get())
            ?? UserFactory::new()->withId(Config::MagnetAnonymousReleaser->get())->create();

        /** @var Magnet $magnet */
        $magnet = $user->magnets()->latest('id')->first();

        $livewire->assertRedirect($magnet->www());

        $this->assertSame($stub->rto_id, $magnet->rto_id);
        $this->assertSame($stub->category_id, $magnet->category_id);

        \Event::assertDispatched(\App\Events\Stats\TorrentAddedAnonymously::class);
        \Notification::assertCount(1);
        \Notification::assertSentTimes(AnonymousMagnetNotification::class, 1);
    }

    public function testStoreAsUser()
    {
        $stub = MagnetFactory::new()->make();
        $user = UserFactory::new()->create();

        $this->fakeHttpRequests($stub);

        \Event::fake(\App\Events\Stats\TorrentAdded::class);

        $this->be($user);

        $livewire = \Livewire::test(MagnetAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id->value)
            ->call('submit')
            ->assertHasNoErrors();

        $magnet = $user->magnets->first();

        $livewire->assertRedirect($magnet->www());

        $this->assertSame($stub->rto_id, $magnet->rto_id);
        $this->assertSame($stub->category_id, $magnet->category_id);

        \Event::assertDispatched(\App\Events\Stats\TorrentAdded::class);
    }

    public function testStoreDuplicate()
    {
        $magnet = MagnetFactory::new()->create();
        $user = UserFactory::new()->create();

        $this->fakeHttpRequests($magnet);

        \Event::fake(\App\Events\Stats\TorrentDuplicateFound::class);

        $this->be($user);

        \Livewire::test(MagnetAddForm::class)
            ->set('input', $magnet->externalLink())
            ->assertHasErrors('input');

        $this->assertCount(0, $user->magnets);

        \Event::assertDispatched(\App\Events\Stats\TorrentDuplicateFound::class);
    }

    public function testStoreWithCurlError()
    {
        $stub = MagnetFactory::new()->make();
        $user = UserFactory::new()->create();

        Exceptions::fake();
        Sleep::fake();

        \Http::fake([
            "api-rto.vacuum.name/v1/get_tor_topic_data?by=topic_id&val={$stub->rto_id}" => \Http::response([
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
            "rto.vacuum.name/forum/viewtopic.php?t={$stub->rto_id}" => \Http::failedConnection(),
        ]);

        $this->be($user);

        \Livewire::test(MagnetAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id->value)
            ->call('submit')
            ->assertHasErrors(['input' => ['Возникли сложности с подключением к рутрекеру. Пожалуйста, повторите попытку']]);

        Exceptions::assertReported(ConnectionException::class);
    }

    public function testStoreUnescapedTitle()
    {
        $stub = MagnetFactory::new()->withTitle('Chlo&#233; Ragnar&#246;k &quot;M&amp;M\'s&quot;')->make();
        $user = UserFactory::new()->create();

        $this->fakeHttpRequests($stub);

        \Event::fake(\App\Events\Stats\TorrentAdded::class);

        $this->be($user);

        $livewire = \Livewire::test(MagnetAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id->value)
            ->call('submit')
            ->assertHasNoErrors();

        $magnet = $user->magnets->first();

        $livewire->assertRedirect($magnet->www());

        $this->assertSame('Chloé Ragnarök "M&M\'s"', $magnet->title);

        \Event::assertDispatched(\App\Events\Stats\TorrentAdded::class);
    }

    private function fakeHttpRequests(Magnet $stub)
    {
        \Http::fake([
            "api-rto.vacuum.name/v1/get_tor_topic_data?by=topic_id&val={$stub->rto_id}" => \Http::response([
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
            "rto.vacuum.name/forum/viewtopic.php?t={$stub->rto_id}" => \Http::response('<div class="post_body">body<fieldset class="attach"><span class="attach_link"><a class="magnet-link" href="magnet:?xt=urn:btih:' . $stub->info_hash . '&tr=' . urlencode($stub->announcer) . '"></a></span></fieldset></div>'),
        ]);
    }
}
