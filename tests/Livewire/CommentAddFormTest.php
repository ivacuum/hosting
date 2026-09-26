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
        \Event::fake(\App\Events\Stats\RuleNotRandomTokenTriggered::class);
        \Mail::fake();

        $news = NewsFactory::new()->create();

        \Livewire::test(CommentAddForm::class, ['model' => $news])
            ->set('email', 'legitimate-comment@example.com')
            ->set('text', $text)
            ->call('submit')
            ->assertHasNoErrors();

        $comment = $news->comments->sole();

        $this->assertSame($text, $comment->html);
        $this->assertSame(CommentStatus::Pending, $comment->status);
        \Event::assertNotDispatched(\App\Events\Stats\RuleNotRandomTokenTriggered::class);
        \Mail::assertQueued(CommentConfirmMail::class);
    }

    public function testCommentIssueAsUser(): void
    {
        \Notification::fake();

        $issue = IssueFactory::new()->withUser()->create();
        $user = UserFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $issue])
            ->set('text', '<p>Comment issue</p>')
            ->call('submit')
            ->assertHasNoErrors();

        \Notification::assertSentTo($issue->user, IssueCommentedNotification::class);

        $comment = $issue->comments->sole();

        $this->assertSame($user->id, $comment->user_id);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('<p>Comment issue</p>', $comment->html);
    }

    public function testCommentMagnetAsUser(): void
    {
        $magnet = MagnetFactory::new()->create();
        $user = UserFactory::new()->create();

        \Event::fake(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $magnet])
            ->set('text', 'Comment magnet')
            ->call('submit')
            ->assertHasNoErrors();

        $comment = $magnet->comments->sole();

        $this->assertSame($user->id, $comment->user_id);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment magnet', $comment->html);

        \Event::assertDispatched(CommentPublished::class);
    }

    public function testCommentNewsAsGuest(): void
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
            ->call('submit')
            ->assertHasNoErrors();

        \Event::assertDispatched(UserRegisteredAuto::class);
        \Mail::assertQueued(CommentConfirmMail::class);
        \Mail::assertOutgoingCount(1);

        $user = User::query()
            ->where(['email' => 'guest-commentator@example.com'])
            ->sole();
        $user->activate();
        $comment = $news->comments->sole();

        $this->assertSame($user->id, $comment->user_id);
        $this->assertSame(CommentStatus::Pending, $comment->status);
        $this->assertSame('Comment &lt;em&gt;text&lt;/em&gt;', $comment->html);

        $this->be($user)
            ->get("comments/{$comment->id}/confirm")
            ->assertRedirect($comment->www());

        $comment->refresh();

        $this->assertSame(CommentStatus::Published, $comment->status);

        \Event::assertDispatched(CommentPublished::class);
    }

    public function testCommentNewsAsUser(): void
    {
        $news = NewsFactory::new()->create();
        $user = UserFactory::new()->create();

        \Event::fake(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $news])
            ->set('text', 'Comment news')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertDispatched(LivewireEvent::RefreshComments->name)
            ->assertSet('text', '');

        $comment = $news->comments->sole();

        $this->assertSame($user->id, $comment->user_id);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment news', $comment->html);

        \Event::assertDispatched(CommentPublished::class);
    }

    public function testCommentTripAsUser(): void
    {
        $trip = TripFactory::new()->create();
        $user = UserFactory::new()->create();

        \Event::fake(CommentPublished::class);

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $trip])
            ->set('text', 'Comment trip')
            ->call('submit')
            ->assertHasNoErrors();

        $comment = $trip->comments->sole();

        $this->assertSame($user->id, $comment->user_id);
        $this->assertSame(CommentStatus::Published, $comment->status);
        $this->assertSame('Comment trip', $comment->html);

        \Event::assertDispatched(CommentPublished::class);
    }

    public function testEscape(): void
    {
        $news = NewsFactory::new()->create();
        $user = UserFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $news])
            ->set('text', 'Comment <em>text</em> " & \'')
            ->call('submit');

        $this->assertSame('Comment &lt;em&gt;text&lt;/em&gt; &quot; &amp; &#039;', $news->comments->sole()->html);
    }

    public function testHiddenNews(): void
    {
        $news = NewsFactory::new()->hidden()->create();
        $user = UserFactory::new()->create();

        \Livewire::actingAs($user)
            ->test(CommentAddForm::class, ['model' => $news])
            ->set('text', 'Comment <em>text</em>')
            ->call('submit')
            ->assertHasErrors('text');

        $this->assertFalse($news->comments()->exists());
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
        \Event::fake(\App\Events\Stats\RuleNotRandomTokenTriggered::class);
        \Mail::fake();

        $news = NewsFactory::new()->create();

        \Livewire::test(CommentAddForm::class, ['model' => $news])
            ->set('email', 'random-token-comment@example.com')
            ->set('text', $text)
            ->call('submit')
            ->assertHasErrors(['text' => __('validation.not_random_token')]);

        $this->assertDatabaseMissing('users', ['email' => 'random-token-comment@example.com']);
        $this->assertFalse($news->comments()->exists());
        \Event::assertDispatchedOnce(\App\Events\Stats\RuleNotRandomTokenTriggered::class);
        \Mail::assertNothingOutgoing();
    }
}
