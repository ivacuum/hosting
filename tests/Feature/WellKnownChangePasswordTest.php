<?php namespace Tests\Feature;

use App\Http\Controllers\WellKnownChangePasswordController;
use Tests\TestCase;

class WellKnownChangePasswordTest extends TestCase
{
    public function testRedirect()
    {
        $this->get(action('\\' . WellKnownChangePasswordController::class))
            ->assertRedirect(action('MyPassword@edit'));
    }
}
