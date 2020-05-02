<?php namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RetrackerTest extends TestCase
{
    use DatabaseTransactions;

    public function testDev()
    {
        $this->get('retracker/dev')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }

    public function testIndex()
    {
        $this->get('retracker')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }

    public function testUsage()
    {
        $this->get('retracker/usage')
            ->assertStatus(200)
            ->assertHasCustomTitle();
    }
}
