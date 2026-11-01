<?php

namespace Tests\Feature;

use App\Factory\CommentFactory;
use App\Factory\NewsFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentUsersForNotificationTest extends TestCase
{
    use DatabaseTransactions;

    public function testCommentersAndAuthorWithoutDuplicates(): void
    {
        $author = UserFactory::new()->create();
        $commenter = UserFactory::new()->create();
        $news = NewsFactory::new()->withUser($author)->create();

        CommentFactory::new()->withNews($news)->withUser($author)->create();
        CommentFactory::new()->withNews($news)->withUser($commenter)->create();
        $comment = CommentFactory::new()->withNews($news)->withUser($commenter)->create();

        $userIds = $comment->usersForNotification($news)
            ->pluck('id')
            ->sort()
            ->values()
            ->all();

        $this->assertSame([$author->id, $commenter->id], $userIds);
    }
}
