<?php

namespace Tests\Feature;

use Tests\TestCase;

class WellKnownChangePasswordTest extends TestCase
{
    public function testRedirect()
    {
        $this->get('.well-known/change-password')
            ->assertRedirect('my/password');
    }
}
