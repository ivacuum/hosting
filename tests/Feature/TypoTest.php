<?php

namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Notifications\TypoReceivedNotification;
use Tests\TestCase;

class TypoTest extends TestCase
{
    public function testTypoPost()
    {
        \Notification::fake();

        UserFactory::new()->create();

        $this->from('/')
            ->post('js/typo', ['selection' => 'Typo is right here'])
            ->assertCreated()
            ->assertJson(['status' => 'OK']);

        \Notification::assertCount(1);
        \Notification::assertSentTimes(TypoReceivedNotification::class, 1);
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
