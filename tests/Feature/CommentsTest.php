<?php namespace Tests\Feature;

use App\Comment;
use App\Events\CommentPublished;
use App\Http\Controllers\AjaxComment;
use App\Mail\CommentConfirm;
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

        /** @var User $user */
        /** @var News $news */
        $user = factory(User::class)->create();
        $news = factory(News::class)->create(['user_id' => $user->id]);
        $email = 'guest+'.random_int(10000, 99999).'@example.com';

        $this->expectsEvents(\App\Events\Stats\UserRegisteredAuto::class);

        $this->postJson(
            action([AjaxComment::class, 'store'], ['type' => 'news', 'id' => $news->id]), [
                'text' => 'some text from the guest',
                'email' => $email,
            ])
            ->assertStatus(201)
            ->assertJsonStructure(['data']);

        \Mail::assertQueued(CommentConfirm::class);

        $comment = Comment::orderByDesc('id')->first();
        $comment->user->activate();

        $this->be($comment->user);

        $this->expectsEvents(CommentPublished::class);

        $this->get(action([\App\Http\Controllers\CommentConfirm::class, 'update'], $comment))
            ->assertRedirect($comment->www());
    }

    public function testCommentPostAsUser()
    {
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        /** @var News $news */
        $news = factory(News::class)->create(['user_id' => $user->id]);

        $this->expectsEvents(CommentPublished::class);

        $this->postJson(
            action([AjaxComment::class, 'store'], ['type' => 'news', 'id' => $news->id]), [
                'text' => 'some text from the user is here',
            ])
            ->assertStatus(201)
            ->assertJsonStructure(['data']);
    }
}
