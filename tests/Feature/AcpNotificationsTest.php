<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Notifications\PlainTextNotification;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpNotificationsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(User::find(1));
    }

    public function testIndex()
    {
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
