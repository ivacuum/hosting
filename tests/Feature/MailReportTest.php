<?php

namespace Tests\Feature;

use App\Factory\EmailFactory;
use App\Mail\CommentConfirmMail;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MailReportTest extends TestCase
{
    use DatabaseTransactions;

    public function testReport()
    {
        $email = EmailFactory::new()
            ->withComment(1)
            ->withTemplate(CommentConfirmMail::class)
            ->create();

        \Event::fake(\App\Events\MailReported::class);

        $this->be($email->user)
            ->get("mail/report/{$email->getTimestamp()}/{$email->id}")
            ->assertFound()
            ->assertRedirect('/')
            ->assertSessionHas('message');

        \Event::assertDispatched(\App\Events\MailReported::class);
    }
}
