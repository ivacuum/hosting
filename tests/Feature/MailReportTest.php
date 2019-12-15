<?php namespace Tests\Feature;

use App\Email;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MailReportTest extends TestCase
{
    use DatabaseTransactions;

    public function testReport()
    {
        /** @var Email $email */
        $email = factory(Email::class)->state('comment')->create();

        $this->expectsEvents(\Ivacuum\Generic\Events\MailReported::class);

        $this->be($email->user)
            ->get("mail/report/{$email->getTimestamp()}/{$email->id}")
            ->assertStatus(302)
            ->assertRedirect('/')
            ->assertSessionHas('message');
    }
}
