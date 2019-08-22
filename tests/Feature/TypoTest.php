<?php namespace Tests\Feature;

use App\Events\TypoReceived;
use Tests\TestCase;

class TypoTest extends TestCase
{
    public function testTypoPost()
    {
        $this->expectsEvents(TypoReceived::class);

        $this->from('/')
            ->post(action('JsTypo'), ['selection' => 'Typo is right here'])
            ->assertStatus(201)
            ->assertJson(['status' => 'OK']);
    }

    public function testTypoPostWithoutPreviousUrlLeadsToError()
    {
        $this->doesntExpectEvents(TypoReceived::class);

        $this->post(action('JsTypo'), ['selection' => 'Should fail without previous visited url'])
            ->assertStatus(422)
            ->assertJson(['status' => 'error']);
    }
}
