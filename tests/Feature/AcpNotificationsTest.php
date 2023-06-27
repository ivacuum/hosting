<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Notifications\PlainTextNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpNotificationsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testIndex()
    {
        $user = UserFactory::new()->create();

        \Notification::send($user, new PlainTextNotification('text'));

        $this->get('acp/notifications')
            ->assertOk();
    }

    public function testShow()
    {
        $user = UserFactory::new()->create();

        \Notification::send($user, new PlainTextNotification('text'));

        $notification = $user->notifications[0];

        $this->get("acp/notifications/{$notification->id}")
            ->assertOk();
    }
}
