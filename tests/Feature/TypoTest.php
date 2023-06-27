<?php

namespace Tests\Feature;

use App\Events\TypoReceived;
use Tests\TestCase;

class TypoTest extends TestCase
{
    public function testTypoPost()
    {
        \Event::fake(TypoReceived::class);

        $this->from('/')
            ->post('js/typo', ['selection' => 'Typo is right here'])
            ->assertCreated()
            ->assertJson(['status' => 'OK']);

        \Event::assertDispatched(TypoReceived::class);
    }

    public function testTypoPostWithoutPreviousUrlLeadsToError()
    {
        \Event::fake(TypoReceived::class);

        $this->post('js/typo', ['selection' => 'Should fail without previous visited url'])
            ->assertUnprocessable()
            ->assertJson(['status' => 'error']);

        \Event::assertNotDispatched(TypoReceived::class);
    }
}
