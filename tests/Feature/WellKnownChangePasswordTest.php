<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class WellKnownChangePasswordTest extends TestCase
{
    use DatabaseTransactions;

    public function testRedirect()
    {
        $this->get('.well-known/change-password')
            ->assertRedirect('my/password');
    }
}
