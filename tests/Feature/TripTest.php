<?php namespace Tests\Feature;

use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TripTest extends TestCase
{
    use DatabaseTransactions;

    public function testShow()
    {
        /** @var Trip $trip */
        $trip = factory(Trip::class)->create();

        $this->get("trips/{$trip->id}")
            ->assertRedirect($trip->www());
    }

    public function testShowWithAnchor()
    {
        /** @var Trip $trip */
        $trip = factory(Trip::class)->create();
        $anchor = '#anchor';

        $this->get("trips/{$trip->id}?anchor=" . urlencode($anchor))
            ->assertRedirect($trip->www($anchor));
    }
}
