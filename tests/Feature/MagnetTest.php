<?php

namespace Tests\Feature;

use App\Domain\Config;
use App\Domain\Magnet\Action\FindRelatedMagnetsAction;
use App\Domain\Magnet\Factory\MagnetFactory;
use App\Domain\Magnet\Livewire\MagnetAddForm;
use App\Domain\Magnet\MagnetCategory;
use App\Domain\Magnet\Models\Magnet;
use App\Domain\Magnet\Notification\AnonymousMagnetNotification;
use App\Domain\Rto\RtoTopicStatus;
use App\Domain\Telegram\Job\SendTelegramMessageJob;
use App\Factory\CommentFactory;
use App\Factory\UserFactory;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Exceptions;
use Illuminate\Support\Sleep;
use Tests\TestCase;

class MagnetTest extends TestCase
{
    use DatabaseTransactions;

    public function testCategoryFilter(): void
    {
        $category = MagnetCategory::ForeignCinema;
        $magnet = MagnetFactory::new()->withCategory($category)->create();

        $this->get("magnets?category_id={$category->value}")
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testComments(): void
    {
        $comment = CommentFactory::new()->withMagnet()->create();

        $this->get('magnets/comments')
            ->assertOk()
            ->assertSee($comment->html);
    }

    public function testCreate(): void
    {
        $user = UserFactory::new()->withId(1)->make();

        $this->be($user)
            ->get('magnets/add')
            ->assertOk()
            ->assertSeeLivewire(MagnetAddForm::class);
    }

    public function testFaq(): void
    {
        $this->get('magnets/faq')
            ->assertOk();
    }

    public function testIndexAsGuest(): void
    {
        $magnet = MagnetFactory::new()->create();

        $this->get('magnets')
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testIndexAsUser(): void
    {
        $this->be(UserFactory::new()->withId(1)->make())
            ->get('magnets')
            ->assertOk();
    }

    public function testLivewireState(): void
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

    public function testMagnetClick(): void
    {
        $magnet = MagnetFactory::new()->create();
        $clicks = $magnet->clicks;

        $this->post("magnets/{$magnet->id}/magnet")
            ->assertNoContent();

        $magnet->refresh();

        $this->assertSame($clicks + 1, $magnet->clicks);
    }

    public function testMy(): void
    {
        $magnet = MagnetFactory::new()->create();

        $this->be($magnet->user)
            ->get('magnets/my')
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testPromo(): void
    {
        \Event::fake(\App\Events\Stats\TorrentPromoViewed::class);

        $this->get('torrent')
            ->assertOk()
            ->assertHasCustomTitle();

        \Event::assertDispatched(\App\Events\Stats\TorrentPromoViewed::class);
    }

    public function testRequestRelease(): void
    {
        \Queue::fake();

        $this
            ->from('magnets')
            ->post('magnets/request', ['query' => 'query'])
            ->assertRedirect('magnets')
            ->assertSessionHasNoErrors();

        \Queue::assertPushed(SendTelegramMessageJob::class);
    }

    public function testSearch(): void
    {
        $magnet = MagnetFactory::new()
            ->withTitle('title 20172017 something else')
            ->create();

        $this->get('magnets?q=20172017')
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testShow(): void
    {
        $magnet = MagnetFactory::new()->create();

        $this->get("magnets/{$magnet->id}")
            ->assertOk()
            ->assertSee($magnet->title);
    }

    public function testShowDeleted(): void
    {
        $magnet = MagnetFactory::new()->deleted()->create();

        $this->get("magnets/{$magnet->id}")
            ->assertNotFound();
    }

    public function testShowHidden(): void
    {
        $magnet = MagnetFactory::new()->hidden()->create();

        $this->get("magnets/{$magnet->id}")
            ->assertNotFound();
    }

    public function testShowWithRelated(): void
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

    public function testStoreAsAnonymous(): void
    {
        \Notification::fake();

        $stub = MagnetFactory::new()->make();

        $this->fakeHttpRequests($stub);

        \Event::fake(\App\Events\Stats\TorrentAddedAnonymously::class);

        $user = User::query()->find(Config::MagnetAnonymousReleaser->get())
            ?? UserFactory::new()->withId(Config::MagnetAnonymousReleaser->get())->create();

        $livewire = \Livewire::test(MagnetAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id->value)
            ->call('submit')
            ->assertHasNoErrors();

        /** @var Magnet $magnet */
        $magnet = $user->magnets()->latest('id')->first();

        $livewire->assertRedirect($magnet->www());

        $this->assertSame($stub->rto_id, $magnet->rto_id);
        $this->assertSame($stub->category_id, $magnet->category_id);

        \Event::assertDispatched(\App\Events\Stats\TorrentAddedAnonymously::class);
        \Notification::assertCount(1);
        \Notification::assertSentTimes(AnonymousMagnetNotification::class, 1);
    }

    public function testStoreAsUser(): void
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

    public function testStoreDuplicate(): void
    {
        $magnet = MagnetFactory::new()->create();
        $user = UserFactory::new()->create();

        $this->fakeHttpRequests($magnet);

        \Event::fake(\App\Events\Stats\TorrentDuplicateFound::class);

        $this->be($user);

        \Livewire::test(MagnetAddForm::class)
            ->set('input', $magnet->externalLink())
            ->assertHasErrors(['input' => 'Данная раздача уже присутствует на сайте. Попробуйте добавить другую.']);

        $this->assertCount(0, $user->magnets);

        \Event::assertDispatched(\App\Events\Stats\TorrentDuplicateFound::class);
    }

    public function testStoreWithCurlError(): void
    {
        $stub = MagnetFactory::new()->make();
        $user = UserFactory::new()->create();

        Exceptions::fake();
        Sleep::fake();

        \Http::fake([
            "api.rutracker.cc/v1/get_tor_topic_data?by=topic_id&val={$stub->rto_id}" => \Http::response([
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
            "rutracker.org/forum/viewtopic.php?t={$stub->rto_id}" => \Http::failedConnection(),
        ]);

        $this->be($user);

        \Livewire::test(MagnetAddForm::class)
            ->set('input', $stub->rto_id)
            ->set('categoryId', $stub->category_id->value)
            ->call('submit')
            ->assertHasErrors(['input' => ['Возникли сложности с подключением к рутрекеру. Пожалуйста, повторите попытку']]);

        Exceptions::assertReported(ConnectionException::class);
    }

    public function testStoreWithRaceCondition(): void
    {
        $stub = MagnetFactory::new()->make();

        $this->fakeHttpRequests($stub);

        $component = \Livewire::test(MagnetAddForm::class)
            ->set('input', $stub->externalLink())
            ->set('categoryId', $stub->category_id->value);

        // Кто-то добавил раздачу параллельно
        MagnetFactory::new()
            ->withRtoId($stub->rto_id)
            ->create();

        $component
            ->call('submit')
            ->assertHasErrors(['input' => 'Данная раздача уже присутствует на сайте. Вероятно, кто-то добавил ее быстрее вас.']);
    }

    public function testStoreWithRtoTemporarilyUnavailable(): void
    {
        \Http::fake([
            'api.rutracker.cc/v1/get_tor_topic_data?by=topic_id&val=1234567890' => \Http::response([
                'error' => [
                    'code' => 1,
                    'text' => 'Temporarily disabled',
                ],
            ]),
        ]);

        \Livewire::test(MagnetAddForm::class)
            ->set('input', '1234567890')
            ->assertHasErrors(['input' => 'Рутрекер временно недоступен. Пожалуйста, повторите попытку позже.']);
    }

    public function testStoreUnescapedTitle(): void
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

    private function fakeHttpRequests(Magnet $stub): void
    {
        \Http::fake([
            "api.rutracker.cc/v1/get_tor_topic_data?by=topic_id&val={$stub->rto_id}" => \Http::response([
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
        ]);
    }
}
