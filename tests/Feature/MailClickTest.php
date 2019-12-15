<?php namespace Tests\Feature;

use App\Email;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MailClickTest extends TestCase
{
    use DatabaseTransactions;

    public function testAuthenticated()
    {
        $goto = '/404/';

        /** @var Email $email */
        $email = factory(Email::class)->state('comment')->create();
        $clicks = $email->clicks;

        $this->expectsEvents([
            \Ivacuum\Generic\Events\Stats\MailClicked::class,
            \Ivacuum\Generic\Events\Stats\UserAutologinWithEmailLink::class,
        ]);

        $queryString = parse_url($email->signedLink($goto), PHP_URL_QUERY);

        $this->get("mail/click/{$email->getTimestamp()}/{$email->id}?{$queryString}")
            ->assertStatus(302)
            ->assertRedirect($goto);

        $email->refresh();

        $this->assertEquals($clicks + 1, $email->clicks);
        $this->assertAuthenticated();
    }
}
