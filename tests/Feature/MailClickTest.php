<?php namespace Tests\Feature;

use App\Factory\EmailFactory;
use App\Mail\CommentConfirmMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MailClickTest extends TestCase
{
    use DatabaseTransactions;

    public function testAuthenticated()
    {
        $email = EmailFactory::new()
            ->withCommentId(1)
            ->withTemplate(CommentConfirmMail::class)
            ->create();

        $goto = '/404/';
        $clicks = $email->clicks;

        \Event::fake([
            \Ivacuum\Generic\Events\Stats\MailClicked::class,
            \Ivacuum\Generic\Events\Stats\UserAutologinWithEmailLink::class,
        ]);

        $queryString = parse_url($email->signedLink($goto), PHP_URL_QUERY);

        $this->get("mail/click/{$email->getTimestamp()}/{$email->id}?{$queryString}")
            ->assertFound()
            ->assertRedirect($goto);

        $email->refresh();

        $this->assertEquals($clicks + 1, $email->clicks);
        $this->assertAuthenticated();

        \Event::assertDispatched(\Ivacuum\Generic\Events\Stats\MailClicked::class);
        \Event::assertDispatched(\Ivacuum\Generic\Events\Stats\UserAutologinWithEmailLink::class);
    }
}
