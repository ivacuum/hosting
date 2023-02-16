<?php namespace Tests\Feature;

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
            ->withCommentId(1)
            ->withTemplate(CommentConfirmMail::class)
            ->create();

        \Event::fake(\Ivacuum\Generic\Events\MailReported::class);

        $this->be($email->user)
            ->get("mail/report/{$email->getTimestamp()}/{$email->id}")
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas('message');

        \Event::assertDispatched(\Ivacuum\Generic\Events\MailReported::class);
    }
}
