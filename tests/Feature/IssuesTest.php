<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Issue;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IssuesTest extends TestCase
{
    use DatabaseTransactions;

    public function testPostIssueAsGuest()
    {
        $this->expectsEvents([
            \App\Events\Stats\IssueAdded::class,
            \App\Events\Stats\UserRegisteredAuto::class,
            \App\Events\Stats\UserRegisteredAutoWhenIssueAdded::class,
        ]);

        $this->from('/')
            ->postJson('contact', [
                'name' => 'name',
                'text' => 'some text from the guest " & \' <>',
                'email' => 'post-issue-as-guest@example.com',
                'title' => 'title',
            ])
            ->assertStatus(201);

        $issue = Issue::firstWhere(['email' => 'post-issue-as-guest@example.com']);

        $this->assertSame('name', $issue->name);
        $this->assertSame('title', $issue->title);
        $this->assertSame('some text from the guest " & \' <>', $issue->text);
    }

    public function testPostIssueAsUser()
    {
        $this->be($user = UserFactory::new()->create())
            ->expectsEvents(\App\Events\Stats\IssueAdded::class)
            ->from('/')
            ->postJson('contact', [
                'name' => 'name',
                'text' => 'some text from the user',
                'email' => $user->email,
                'title' => 'title',
            ])
            ->assertStatus(201);
    }
}
