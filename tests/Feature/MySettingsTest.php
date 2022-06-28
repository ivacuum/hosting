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

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\MySettingsChanged::class)
            ->put('my/settings', ['locale' => Locale::Eng->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(Locale::Eng->value, $user->locale);
    }

    public function testUpdateNotifyGigsToDisabled()
    {
        $user = UserFactory::new()->make();
        $user->notify_gigs = NotificationDeliveryMethod::Mail;
        $user->save();

        $this->be($user)
            ->expectsEvents([
                \App\Events\Stats\GigsUnsubscribed::class,
                \App\Events\Stats\MySettingsChanged::class,
            ])
            ->put('my/settings', ['notify_gigs' => NotificationDeliveryMethod::Disabled->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Disabled, $user->notify_gigs);
    }

    public function testUpdateNotifyGigsToMail()
    {
        $user = UserFactory::new()->make();
        $user->notify_gigs = NotificationDeliveryMethod::Disabled;
        $user->save();

        $this->be($user)
            ->expectsEvents([
                \App\Events\Stats\GigsSubscribed::class,
                \App\Events\Stats\MySettingsChanged::class,
            ])
            ->put('my/settings', ['notify_gigs' => NotificationDeliveryMethod::Mail->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_gigs);
    }

    public function testUpdateNotifyNewsToDisabled()
    {
        $user = UserFactory::new()->make();
        $user->notify_news = NotificationDeliveryMethod::Mail;
        $user->save();

        $this->be($user)
            ->expectsEvents([
                \App\Events\Stats\NewsUnsubscribed::class,
                \App\Events\Stats\MySettingsChanged::class,
            ])
            ->put('my/settings', ['notify_news' => NotificationDeliveryMethod::Disabled->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Disabled, $user->notify_news);
    }

    public function testUpdateNotifyNewsToMail()
    {
        $user = UserFactory::new()->make();
        $user->notify_news = NotificationDeliveryMethod::Disabled;
        $user->save();

        $this->be($user)
            ->expectsEvents([
                \App\Events\Stats\NewsSubscribed::class,
                \App\Events\Stats\MySettingsChanged::class,
            ])
            ->put('my/settings', ['notify_news' => NotificationDeliveryMethod::Mail->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_news);
    }

    public function testUpdateNotifyTripsToDisabled()
    {
        $user = UserFactory::new()->make();
        $user->notify_trips = NotificationDeliveryMethod::Mail;
        $user->save();

        $this->be($user)
            ->expectsEvents([
                \App\Events\Stats\TripsUnsubscribed::class,
                \App\Events\Stats\MySettingsChanged::class,
            ])
            ->put('my/settings', ['notify_trips' => NotificationDeliveryMethod::Disabled->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Disabled, $user->notify_trips);
    }

    public function testUpdateNotifyTripsToMail()
    {
        $user = UserFactory::new()->make();
        $user->notify_trips = NotificationDeliveryMethod::Disabled;
        $user->save();

        $this->be($user)
            ->expectsEvents([
                \App\Events\Stats\TripsSubscribed::class,
                \App\Events\Stats\MySettingsChanged::class,
            ])
            ->put('my/settings', ['notify_trips' => NotificationDeliveryMethod::Mail->value])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_trips);
    }

    public function testUpdateTorrentShortTitle()
    {
        $user = UserFactory::new()->make();
        $user->torrent_short_title = 0;
        $user->save();

        $this->be($user)
            ->expectsEvents(\App\Events\Stats\MySettingsChanged::class)
            ->put('my/settings', ['torrent_short_title' => 1])
            ->assertStatus(302);

        $user->refresh();

        $this->assertSame(1, $user->torrent_short_title);
    }
}
