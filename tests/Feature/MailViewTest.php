<?php namespace Tests\Feature;

use App\Email;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class MailViewTest extends TestCase
{
    use DatabaseTransactions;

    public function testCalendar()
    {
        /** @var Email $email */
        $email = factory(Email::class)->state('comment')->create();

        $this->expectsEvents(\Ivacuum\Generic\Events\Stats\MailViewed::class);

        $this->get("mail/view/{$email->getTimestamp()}/{$email->id}")
            ->assertNoContent();
    }
}
