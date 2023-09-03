<?php

namespace Tests\Livewire;

use App\Domain\CommentStatus;
use App\Domain\LivewireEvent;
use App\Events\CommentPublished;
use App\Events\Stats\UserRegisteredAuto;
use App\Factory\IssueFactory;
use App\Factory\MagnetFactory;
use App\Factory\NewsFactory;
use App\Factory\TripFactory;
use App\Factory\UserFactory;
use App\Livewire\CommentAddForm;
use App\Mail\CommentConfirmMail;
use App\Notifications\IssueCommentedNotification;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CommentAddFormTest extends TestCase
{
    use DatabaseTransactions;

    public function testCommentIssueAsUser()
    {
        \Notification::fake();

        $issue = IssueFactory::new()->withUser()->create();
        $user = UserFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $issue])
            ->set('text', '<p>Comment issue</p>')
            ->call('submit');

        \Notification::assertSentTo($issue->user, IssueCommentedNotification::class);

        $comment = $user->comments[0];

        $this->assertCount(1, $user->comments);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('<p>Comment issue</p>', $comment->html);
    }

    public function testCommentMagnetAsUser()
    {
        $magnet = MagnetFactory::new()->create();
        $user = UserFactory::new()->create();

        \Event::fake(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $magnet])
            ->set('text', 'Comment magnet')
            ->call('submit');

        $comment = $user->comments[0];

        $this->assertCount(1, $user->comments);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment magnet', $comment->html);

        \Event::assertDispatched(CommentPublished::class);
    }

    public function testCommentNewsAsGuest()
    {
        \Event::fake([
            UserRegisteredAuto::class,
            CommentPublished::class,
        ]);
        \Mail::fake();

        $news = NewsFactory::new()->create();

        \Livewire::test(CommentAddForm::class, ['model' => $news])
            ->set('email', 'guest-commentator@example.com')
            ->set('text', 'Comment <em>text</em>')
            ->call('submit');

        \Event::assertDispatched(UserRegisteredAuto::class);
        \Mail::assertQueued(CommentConfirmMail::class);
        \Mail::assertOutgoingCount(1);

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

        \Event::assertDispatched(CommentPublished::class);
    }

    public function testCommentNewsAsUser()
    {
        $news = NewsFactory::new()->create();
        $user = UserFactory::new()->create();

        \Event::fake(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $news])
            ->set('text', 'Comment news')
            ->call('submit')
            ->assertDispatched(LivewireEvent::RefreshComments->name)
            ->assertSet('text', '');

        $comment = $user->comments[0];

        $this->assertCount(1, $user->comments);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment news', $comment->html);

        \Event::assertDispatched(CommentPublished::class);
    }

    public function testCommentTripAsUser()
    {
        $trip = TripFactory::new()->create();
        $user = UserFactory::new()->create();

        \Event::fake(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $trip])
            ->set('text', 'Comment trip')
            ->call('submit');

        $comment = $user->comments[0];

        $this->assertCount(1, $user->comments);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment trip', $comment->html);

        \Event::assertDispatched(CommentPublished::class);
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
