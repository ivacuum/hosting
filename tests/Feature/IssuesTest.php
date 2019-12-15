<?php namespace Tests\Feature;

use App\User;
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
        /** @var User $user */
        $this->be($user = factory(User::class)->create());

        $this->expectsEvents(\App\Events\Stats\IssueAdded::class);

        $this->from('/')
            ->postJson('contact', [
                'name' => 'name',
                'text' => 'some text from the user',
                'email' => $user->email,
                'title' => 'title',
            ])
            ->assertStatus(201);
    }
}
