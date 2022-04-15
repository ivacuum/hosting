<?php namespace Tests\Feature;

use App\Comment;
use App\Events\CommentPublished;
use App\Factory\MagnetFactory;
use App\Factory\NewsFactory;
use App\Factory\TripFactory;
use App\Mail\CommentConfirmMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use DatabaseTransactions;

    public function testCommentEscape()
    {
        $news = NewsFactory::new()->create();

        $this->be($news->user)
            ->expectsEvents(CommentPublished::class)
            ->postJson("ajax/comment/news/{$news->id}", ['text' => 'some text from the user is here " & \' <>'])
            ->assertCreated()
            ->assertJsonStructure(['data']);

        $comment = $news->comments->first();

        // Ранние комментарии в html, а новые экранируем
        $this->assertSame('some text from the user is here &quot; &amp; &#039; &lt;&gt;', $comment->html);
    }

    public function testCommentNewsAsGuest()
    {
        \Mail::fake();

        $news = NewsFactory::new()->create();
        $email = 'guest+' . random_int(10000, 99999) . '@example.com';

        $this->expectsEvents(\App\Events\Stats\UserRegisteredAuto::class)
            ->postJson("ajax/comment/news/{$news->id}", [
                'text' => 'some text from the guest',
                'email' => $email,
            ])
            ->assertCreated()
            ->assertJsonStructure(['data']);

        \Mail::assertQueued(CommentConfirmMail::class);

        /** @var Comment $comment */
        $comment = Comment::orderByDesc('id')->first();
        $comment->user->activate();

        $this->expectsEvents(CommentPublished::class);

        $this->be($comment->user)
            ->get("comments/{$comment->id}/confirm")
            ->assertRedirect($comment->www());
    }

    public function testCommentMagnetAsUser()
    {
        $magnet = MagnetFactory::new()->create();

        $this->be($magnet->user)
            ->expectsEvents(CommentPublished::class)
            ->postJson("ajax/comment/magnet/{$magnet->id}", ['text' => 'some text from the user is here'])
            ->assertCreated()
            ->assertJsonStructure(['data']);
    }

    public function testCommentNewsAsUser()
    {
        $news = NewsFactory::new()->create();

        $this->be($news->user)
            ->expectsEvents(CommentPublished::class)
            ->postJson("ajax/comment/news/{$news->id}", ['text' => 'some text from the user is here'])
            ->assertCreated()
            ->assertJsonStructure(['data']);
    }

    public function testCommentTripAsUser()
    {
        $trip = TripFactory::new()->withUser()->create();

        $this->be($trip->user)
            ->expectsEvents(CommentPublished::class)
            ->postJson("ajax/comment/trip/{$trip->id}", ['text' => 'some text from the user is here'])
            ->assertCreated()
            ->assertJsonStructure(['data']);
    }
}
