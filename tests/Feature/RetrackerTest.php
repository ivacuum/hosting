<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RetrackerTest extends TestCase
{
    use DatabaseTransactions;

    public function testDev()
    {
        $this->get('retracker/dev')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testIndex()
    {
        $this->get('retracker')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testUsage()
    {
        $this->get('retracker/usage')
            ->assertOk()
            ->assertHasCustomTitle();
    }
}
