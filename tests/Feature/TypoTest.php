<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Notifications\TypoReportedNotification;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TypoTest extends TestCase
{
    use DatabaseTransactions;

    public function testTypoPost()
    {
        \Notification::fake();

        UserFactory::new()->create();

        $this->from('/')
            ->post('js/typo', ['selection' => 'Typo is right here'])
            ->assertCreated()
            ->assertJson(['status' => 'OK']);

        \Notification::assertCount(1);
        \Notification::assertSentTimes(TypoReportedNotification::class, 1);
    }

    public function testTypoPostWithoutPreviousUrlLeadsToError()
    {
        \Notification::fake();

        $this->post('js/typo', ['selection' => 'Should fail without previous visited url'])
            ->assertUnprocessable()
            ->assertJson(['status' => 'error']);

        \Notification::assertNothingSent();
    }
}
