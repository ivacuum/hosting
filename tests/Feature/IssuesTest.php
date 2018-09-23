<?php namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class IssuesTest extends TestCase
{
    use DatabaseTransactions;

    public function testPostIssueAsGuest()
    {
        $email = 'guest+'.random_int(10000, 99999).'@example.com';

        $this->expectsEvents([
            \App\Events\Stats\IssueAdded::class,
            \App\Events\Stats\UserRegisteredAuto::class,
        ]);

        // Оставить обратную связь можно только с какой-либо страницы сайта
        $this->get('/')->assertStatus(200);

        $this->postJson(
            action('Issues@store'), [
                'name' => 'name',
                'text' => 'some text from the guest',
                'email' => $email,
                'title' => 'title',
            ])
            ->assertStatus(201);
    }

    public function testPostIssueAsUser()
    {
        /* @var User $user */
        $this->be($user = factory(User::class)->create());

        // Оставить обратную связь можно только с какой-либо страницы сайта
        $this->get('/')->assertStatus(200);

        $this->expectsEvents(\App\Events\Stats\IssueAdded::class);

        $this->postJson(
                action('Issues@store'), [
                'name' => 'name',
                'text' => 'some text from the guest',
                'email' => $user->email,
                'title' => 'title',
            ])
            ->assertStatus(201);
    }
}
