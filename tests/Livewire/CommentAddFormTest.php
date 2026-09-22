<?php

namespace Tests\Livewire;

use App\Domain\CommentStatus;
use App\Domain\Life\Factory\TripFactory;
use App\Domain\LivewireEvent;
use App\Domain\Magnet\Factory\MagnetFactory;
use App\Events\CommentPublished;
use App\Events\Stats\UserRegisteredAuto;
use App\Factory\IssueFactory;
use App\Factory\NewsFactory;
use App\Factory\UserFactory;
use App\Livewire\CommentAddForm;
use App\Mail\CommentConfirmMail;
use App\Notifications\IssueCommentedNotification;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class CommentAddFormTest extends TestCase
{
    use DatabaseTransactions;

    #[TestWith(['Спасибо!'])]
    #[TestWith(['Thanks!'])]
    #[TestWith(['Internationalization'])]
    #[TestWith(['ОЧЕНЬ КРАСИВО'])]
    #[TestWith(['Что означает EEXJHdFzqdFXgjMbPdP?'])]
    public function testAcceptsLegitimateComments(string $text): void
    {
        \Mail::fake();

        $news = NewsFactory::new()->create();

        \Livewire::test(CommentAddForm::class, ['model' => $news])
            ->set('email', 'legitimate-comment@example.com')
            ->set('text', $text)
            ->call('submit')
            ->assertHasNoErrors();

        $comment = $news->comments()->sole();

        $this->assertSame($text, $comment->html);
        $this->assertSame(CommentStatus::Pending, $comment->status);
        \Mail::assertQueued(CommentConfirmMail::class);
    }

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

        $comment = $user->comments->first();

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

        $comment = $user->comments->first();

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

        $user = User::query()
            ->where(['email' => 'guest-commentator@example.com'])
            ->firstOrFail();
        $user->activate();
        $comment = $user->comments->first();

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

        $comment = $user->comments->first();

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

        $comment = $user->comments->first();

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

        $this->assertSame('Comment &lt;em&gt;text&lt;/em&gt; &quot; &amp; &#039;', $user->comments->first()->html);
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

    public function testHoneypot(): void
    {
        \Event::fake(\App\Events\Stats\SpammerTrappedLivewire::class);
        \Mail::fake();

        $news = NewsFactory::new()->create();

        \Livewire::test(CommentAddForm::class, ['model' => $news])
            ->set('email', 'comment-honeypot@example.com')
            ->set('text', 'Automated comment')
            ->set('mail', 'bot')
            ->call('submit')
            ->assertHasErrors(['mail' => __('auth.spammer_trapped')]);

        $this->assertDatabaseMissing('users', ['email' => 'comment-honeypot@example.com']);
        $this->assertFalse($news->comments()->exists());

        \Event::assertDispatched(\App\Events\Stats\SpammerTrappedLivewire::class);
        \Mail::assertNothingOutgoing();
    }

    #[TestWith(['EEXJHdFzqdFXgjMbPdP'])]
    #[TestWith(['DVrLxRFRUVitavbeG'])]
    #[TestWith(['rJDeeVuuwjfvazGAkxDIIP'])]
    #[TestWith(['wUlOLgWsEHmRNzZSxVCzMmw'])]
    #[TestWith([" \tEEXJHdFzqdFXgjMbPdP\n"])]
    public function testRejectsRandomTokenComments(string $text): void
    {
        \Mail::fake();

        $news = NewsFactory::new()->create();

        \Livewire::test(CommentAddForm::class, ['model' => $news])
            ->set('email', 'random-token-comment@example.com')
            ->set('text', $text)
            ->call('submit')
            ->assertHasErrors(['text' => __('validation.not_random_token')]);

        $this->assertDatabaseMissing('users', ['email' => 'random-token-comment@example.com']);
        $this->assertFalse($news->comments()->exists());
        \Mail::assertNothingOutgoing();
    }
}
