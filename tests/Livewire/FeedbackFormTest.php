<?php namespace Tests\Livewire;

use App\Action\LimitRateAction;
use App\Factory\UserFactory;
use App\Http\Livewire\FeedbackForm;
use App\Issue;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FeedbackFormTest extends TestCase
{
    use DatabaseTransactions;

    public function testAsGuest()
    {
        $this->mock(LimitRateAction::class)->shouldReceive('execute')->andReturn(false);

        $this->expectsEvents([
            \App\Events\Stats\IssueAdded::class,
            \App\Events\Stats\UserRegisteredAuto::class,
            \App\Events\Stats\UserRegisteredAutoWhenIssueAdded::class,
        ]);

        \Livewire::test(FeedbackForm::class)
            ->set('name', 'name')
            ->set('email', 'post-issue-as-guest@example.com')
            ->set('title', 'title')
            ->set('text', 'some text from the guest " & \' <>')
            ->call('submit')
            ->assertHasNoErrors();

        $issue = Issue::firstWhere(['email' => 'post-issue-as-guest@example.com']);

        $this->assertSame('name', $issue->name);
        $this->assertSame('title', $issue->title);
        $this->assertSame('some text from the guest " & \' <>', $issue->text);
    }

    public function testAsUserWithLogin()
    {
        $this->mock(LimitRateAction::class)->shouldReceive('execute')->andReturn(false);

        $user = UserFactory::new()->withLogin('post-issue')->create();

        $this->expectsEvents(\App\Events\Stats\IssueAdded::class);

        \Livewire::actingAs($user)
            ->test(FeedbackForm::class)
            ->set('title', 'title')
            ->set('text', 'some text from the user')
            ->call('submit')
            ->assertHasNoErrors();

        $issue = Issue::firstWhere(['user_id' => $user->id]);

        $this->assertSame('post-issue', $issue->name);
        $this->assertSame('title', $issue->title);
        $this->assertSame('some text from the user', $issue->text);
    }

    public function testWithNameHidden()
    {
        $this->mock(LimitRateAction::class)->shouldReceive('execute')->andReturn(false);

        \Livewire::test(FeedbackForm::class, ['hideName' => true])
            ->set('email', 'name-hidden@example.com')
            ->set('title', 'title')
            ->set('text', 'name hidden')
            ->call('submit')
            ->assertHasNoErrors();

        $issue = Issue::firstWhere(['email' => 'name-hidden@example.com']);

        $this->assertSame('', $issue->name);
        $this->assertSame('title', $issue->title);
        $this->assertSame('name hidden', $issue->text);
    }

    public function testWithTitleHidden()
    {
        $this->mock(LimitRateAction::class)->shouldReceive('execute')->andReturn(false);

        \Livewire::test(FeedbackForm::class, ['hideTitle' => true])
            ->set('name', 'name')
            ->set('email', 'title-hidden@example.com')
            ->set('text', 'title hidden')
            ->call('submit')
            ->assertHasNoErrors();

        $issue = Issue::firstWhere(['email' => 'title-hidden@example.com']);

        $this->assertSame('name', $issue->name);
        $this->assertSame('', $issue->title);
        $this->assertSame('title hidden', $issue->text);
    }

    public function testWithTitlePrefilled()
    {
        $this->mock(LimitRateAction::class)->shouldReceive('execute')->andReturn(false);

        \Livewire::test(FeedbackForm::class, ['hideTitle' => true, 'title' => 'FAQ'])
            ->set('name', 'name')
            ->set('email', 'title-prefilled@example.com')
            ->set('text', 'title prefilled')
            ->call('submit')
            ->assertHasNoErrors();

        $issue = Issue::firstWhere(['email' => 'title-prefilled@example.com']);

        $this->assertSame('name', $issue->name);
        $this->assertSame('FAQ', $issue->title);
        $this->assertSame('title prefilled', $issue->text);
    }
}
