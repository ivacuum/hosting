<?php namespace Tests\Livewire;

use App\Domain\CommentStatus;
use App\Domain\LivewireEvent;
use App\Events\CommentPublished;
use App\Events\Stats\UserRegisteredAuto;
use App\Factory\MagnetFactory;
use App\Factory\NewsFactory;
use App\Factory\TripFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\CommentAddForm;
use App\Mail\CommentConfirmMail;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentAddFormTest extends TestCase
{
    use DatabaseTransactions;

    public function testCommentMagnetAsUser()
    {
        $magnet = MagnetFactory::new()->create();
        $user = UserFactory::new()->create();

        $this->expectsEvents(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $magnet])
            ->set('text', 'Comment magnet')
            ->call('submit');

        $comment = $user->comments[0];

        $this->assertCount(1, $user->comments);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment magnet', $comment->html);
    }

    public function testCommentNewsAsGuest()
    {
        \Mail::fake();

        $news = NewsFactory::new()->create();

        $this->expectsEvents([
            UserRegisteredAuto::class,
            CommentPublished::class,
        ]);

        \Livewire::test(CommentAddForm::class, ['model' => $news])
            ->set('email', 'guest-commentator@example.com')
            ->set('text', 'Comment <em>text</em>')
            ->call('submit');

        \Mail::assertQueued(CommentConfirmMail::class);

        $user = User::firstWhere(['email' => 'guest-commentator@example.com']);
        $user->activate();
        $comment = $user->comments[0];

        $this->assertCount(1, $user->comments);
        $this->assertSame(CommentStatus::Pending, $comment->status);
        $this->assertSame('Comment &lt;em&gt;text&lt;/em&gt;', $comment->html);

        $this->be($user)
            ->get("comments/{$comment->id}/confirm")
            ->assertRedirect($comment->www());

        $comment->refresh();

        $this->assertSame(CommentStatus::Published, $comment->status);
    }

    public function testCommentNewsAsUser()
    {
        $news = NewsFactory::new()->create();
        $user = UserFactory::new()->create();

        $this->expectsEvents(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $news])
            ->set('text', 'Comment news')
            ->call('submit')
            ->assertEmitted(LivewireEvent::RefreshComments->name)
            ->assertSet('text', '');

        $comment = $user->comments[0];

        $this->assertCount(1, $user->comments);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment news', $comment->html);
    }

    public function testCommentTripAsUser()
    {
        $trip = TripFactory::new()->create();
        $user = UserFactory::new()->create();

        $this->expectsEvents(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $trip])
            ->set('text', 'Comment trip')
            ->call('submit');

        $comment = $user->comments[0];

        $this->assertCount(1, $user->comments);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment trip', $comment->html);
    }

    public function testEscape()
    {
        $news = NewsFactory::new()->create();
        $user = UserFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $news])
            ->set('text', 'Comment <em>text</em> " & \'')
            ->call('submit');

        $this->assertSame('Comment &lt;em&gt;text&lt;/em&gt; &quot; &amp; &#039;', $user->comments[0]->html);
    }

    public function testHiddenNews()
    {
        $news = NewsFactory::new()->hidden()->create();
        $user = UserFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $news])
            ->set('text', 'Comment <em>text</em>')
            ->call('submit')
            ->assertHasErrors('text');
    }
}
