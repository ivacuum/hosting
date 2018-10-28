<?php namespace Tests\Feature;

use App\Comment;
use App\Notifications\NewsCommented;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class NotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function testNewsCommentedNotificationInList()
    {
        /** @var Comment $comment */
        $comment = factory(Comment::class)->state('news')->create();
        $notifiable = factory(User::class)->create();

        \Notification::send($notifiable, new NewsCommented($comment->rel, $comment));

        $this->be($notifiable)
            ->get(action('Notifications@index'))
            ->assertStatus(200);
    }
}
