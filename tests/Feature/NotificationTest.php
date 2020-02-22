<?php namespace Tests\Feature;

use App\Factory\CommentFactory;
use App\Factory\UserFactory;
use App\Notifications\NewsCommentedNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function testNewsCommentedNotificationInList()
    {
        $comment = CommentFactory::new()->withNews()->create();
        $notifiable = UserFactory::new()->create();

        \Notification::send($notifiable, new NewsCommentedNotification($comment->rel, $comment));

        $this->be($notifiable)
            ->get('notifications')
            ->assertStatus(200);
    }
}
