<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IssuesTest extends TestCase
{
    use DatabaseTransactions;

    public function testPostIssueAsGuest()
    {
        $email = 'guest+' . random_int(10000, 99999) . '@example.com';

        $this->expectsEvents([
            \App\Events\Stats\IssueAdded::class,
            \App\Events\Stats\UserRegisteredAuto::class,
        ]);

        $this->from('/')
            ->postJson('contact', [
                'name' => 'name',
                'text' => 'some text from the guest',
                'email' => $email,
                'title' => 'title',
            ])
            ->assertStatus(201);
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
