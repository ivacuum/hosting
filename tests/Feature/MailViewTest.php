<?php

namespace Tests\Feature;

use App\Factory\EmailFactory;
use App\Mail\CommentConfirmMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MailViewTest extends TestCase
{
    use DatabaseTransactions;

    public function testCalendar()
    {
        $email = EmailFactory::new()
            ->withComment(1)
            ->withTemplate(CommentConfirmMail::class)
            ->create();

        \Event::fake(\App\Events\Stats\MailViewed::class);

        $this->get("mail/view/{$email->getTimestamp()}/{$email->id}")
            ->assertNoContent();

        \Event::assertDispatched(\App\Events\Stats\MailViewed::class);
    }
}
