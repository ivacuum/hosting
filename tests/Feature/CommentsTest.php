<?php namespace Tests\Feature;

use App\Comment;
use App\Events\CommentPublished;
use App\Mail\CommentConfirmMail;
use App\News;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use DatabaseTransactions;

    public function testCommentPostAsGuest()
    {
        \Mail::fake();

        /** @var News $news */
        $user = $this->user();
        $news = factory(News::class)->create(['user_id' => $user->id]);
        $email = 'guest+' . random_int(10000, 99999) . '@example.com';

        $this->expectsEvents(\App\Events\Stats\UserRegisteredAuto::class);

        $this->postJson("ajax/comment/news/{$news->id}", [
                'text' => 'some text from the guest',
                'email' => $email,
            ])
            ->assertStatus(201)
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

    public function testCommentPostAsUser()
    {
        $this->be($user = $this->user());

        /** @var News $news */
        $news = factory(News::class)->create(['user_id' => $user->id]);

        $this->expectsEvents(CommentPublished::class);

        $this->postJson("ajax/comment/news/{$news->id}", ['text' => 'some text from the user is here'])
            ->assertStatus(201)
            ->assertJsonStructure(['data']);
    }

    private function user(): User
    {
        return factory(User::class)->create();
    }
}
