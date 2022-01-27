<?php namespace Tests\Feature;

use App\Domain\NotificationDeliveryMethod;
use App\Factory\UserFactory;
use App\Mail\SubscriptionConfirmMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class SubscriptionsTest extends TestCase
{
    use DatabaseTransactions;

    public function testConfirm()
    {
        $hash = \Crypt::encryptString(implode(',', ['gigs', 'news', 'trips']));
        $user = UserFactory::new()->create();

        $this->be($user)
            ->get("subscriptions/confirm?hash={$hash}")
            ->assertRedirect('my/settings')
            ->assertSessionHas('message');

        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_gigs);
        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_news);
        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_trips);
    }

    public function testEditAsGuest()
    {
        $this->get('subscriptions')
            ->assertStatus(200);
    }

    public function testEditAsUser()
    {
        $this->be(UserFactory::new()->make())
            ->get('subscriptions')
            ->assertRedirect('my/settings');
    }

    public function testSubscribeAsGuest()
    {
        \Mail::fake();

        $email = 'guest+' . random_int(10000, 99999) . '@example.com';

        $this->expectsEvents(\App\Events\Stats\UserRegisteredAutoWhenSubscribing::class)
            ->post('subscriptions', [
                'gigs' => 1,
                'news' => 1,
                'email' => $email,
                'trips' => 1,
            ])
            ->assertRedirect('subscriptions')
            ->assertSessionHas('message');

        \Mail::assertQueued(SubscriptionConfirmMail::class);
    }

    public function testSubscribeAsUser()
    {
        \Mail::fake();

        $email = 'guest+' . random_int(10000, 99999) . '@example.com';

        $this->be(UserFactory::new()->create())
            ->doesntExpectEvents(\App\Events\Stats\UserRegisteredAutoWhenSubscribing::class)
            ->post('subscriptions', [
                'gigs' => NotificationDeliveryMethod::Mail->value,
                'news' => NotificationDeliveryMethod::Mail->value,
                'email' => $email,
                'trips' => NotificationDeliveryMethod::Mail->value,
            ])
            ->assertRedirect('subscriptions')
            ->assertSessionHas('message');

        \Mail::assertQueued(SubscriptionConfirmMail::class);
    }

    public function testUpdate()
    {
        $user = UserFactory::new()->create();

        $this->be($user)
            ->from('life')
            ->put('subscriptions', [
                'gigs' => NotificationDeliveryMethod::Mail->value,
                'news' => NotificationDeliveryMethod::Mail->value,
                'trips' => NotificationDeliveryMethod::Mail->value,
            ])
            ->assertRedirect('life')
            ->assertSessionHas('message');

        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_gigs);
        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_news);
        $this->assertSame(NotificationDeliveryMethod::Mail, $user->notify_trips);
    }
}
