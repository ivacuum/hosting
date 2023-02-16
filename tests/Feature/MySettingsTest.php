<?php namespace Tests\Feature;

use App\Domain\Locale;
use App\Domain\NotificationDeliveryMethod;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MySettingsTest extends TestCase
{
    use DatabaseTransactions;

    public function testEdit()
    {
        $this->be(UserFactory::new()->create())
            ->get('my/settings')
            ->assertOk();
    }

    public function testUpdateLocale()
    {
        $user = UserFactory::new()->make();
        $user->locale = Locale::Eng->value;
        $user->save();

        \Event::fake(\App\Events\Stats\MySettingsChanged::class);

        $this->be($user)
            ->put('my/settings', ['locale' => Locale::Eng->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(Locale::Eng->value, $user->locale);

        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }

    public function testUpdateNotifyGigsToDisabled()
    {
        $user = UserFactory::new()->make();
        $user->notify_gigs = NotificationDeliveryMethod::Mail;
        $user->save();

        \Event::fake([
            \App\Events\Stats\GigsUnsubscribed::class,
            \App\Events\Stats\MySettingsChanged::class,
        ]);

        $this->be($user)
            ->put('my/settings', ['notify_gigs' => NotificationDeliveryMethod::Disabled->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Disabled, $user->notify_gigs);

        \Event::assertDispatched(\App\Events\Stats\GigsUnsubscribed::class);
        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }

    public function testUpdateNotifyGigsToMail()
    {
        $user = UserFactory::new()->make();
        $user->notify_gigs = NotificationDeliveryMethod::Disabled;
        $user->save();

        \Event::fake([
            \App\Events\Stats\GigsSubscribed::class,
            \App\Events\Stats\MySettingsChanged::class,
        ]);

        $this->be($user)
            ->put('my/settings', ['notify_gigs' => NotificationDeliveryMethod::Mail->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_gigs);

        \Event::assertDispatched(\App\Events\Stats\GigsSubscribed::class);
        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }

    public function testUpdateNotifyNewsToDisabled()
    {
        $user = UserFactory::new()->make();
        $user->notify_news = NotificationDeliveryMethod::Mail;
        $user->save();

        \Event::fake([
            \App\Events\Stats\NewsUnsubscribed::class,
            \App\Events\Stats\MySettingsChanged::class,
        ]);

        $this->be($user)
            ->put('my/settings', ['notify_news' => NotificationDeliveryMethod::Disabled->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Disabled, $user->notify_news);

        \Event::assertDispatched(\App\Events\Stats\NewsUnsubscribed::class);
        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }

    public function testUpdateNotifyNewsToMail()
    {
        $user = UserFactory::new()->make();
        $user->notify_news = NotificationDeliveryMethod::Disabled;
        $user->save();

        \Event::fake([
            \App\Events\Stats\NewsSubscribed::class,
            \App\Events\Stats\MySettingsChanged::class,
        ]);

        $this->be($user)
            ->put('my/settings', ['notify_news' => NotificationDeliveryMethod::Mail->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_news);

        \Event::assertDispatched(\App\Events\Stats\NewsSubscribed::class);
        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }

    public function testUpdateNotifyTripsToDisabled()
    {
        $user = UserFactory::new()->make();
        $user->notify_trips = NotificationDeliveryMethod::Mail;
        $user->save();

        \Event::fake([
            \App\Events\Stats\TripsUnsubscribed::class,
            \App\Events\Stats\MySettingsChanged::class,
        ]);

        $this->be($user)
            ->put('my/settings', ['notify_trips' => NotificationDeliveryMethod::Disabled->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Disabled, $user->notify_trips);

        \Event::assertDispatched(\App\Events\Stats\TripsUnsubscribed::class);
        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }

    public function testUpdateNotifyTripsToMail()
    {
        $user = UserFactory::new()->make();
        $user->notify_trips = NotificationDeliveryMethod::Disabled;
        $user->save();

        \Event::fake([
            \App\Events\Stats\TripsSubscribed::class,
            \App\Events\Stats\MySettingsChanged::class,
        ]);

        $this->be($user)
            ->put('my/settings', ['notify_trips' => NotificationDeliveryMethod::Mail->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_trips);

        \Event::assertDispatched(\App\Events\Stats\TripsSubscribed::class);
        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }

    public function testUpdateTorrentShortTitle()
    {
        $user = UserFactory::new()->make();
        $user->torrent_short_title = 0;
        $user->save();

        \Event::fake(\App\Events\Stats\MySettingsChanged::class);

        $this->be($user)
            ->put('my/settings', ['torrent_short_title' => 1])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(1, $user->torrent_short_title);

        \Event::assertDispatched(\App\Events\Stats\MySettingsChanged::class);
    }
}
