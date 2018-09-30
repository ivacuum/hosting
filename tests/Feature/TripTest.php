<?php namespace Tests\Feature;

use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TripTest extends TestCase
{
    use DatabaseTransactions;

    public function testShow()
    {
        /* @var Trip $trip */
        $trip = factory(Trip::class)->create();

        $this->get(action('Trips@show', $trip))
            ->assertRedirect($trip->www());
    }

    public function testShowWithAnchor()
    {
        /* @var Trip $trip */
        $trip = factory(Trip::class)->create();
        $anchor = '#anchor';

        $this->get(action('Trips@show', [$trip, 'anchor' => $anchor]))
            ->assertRedirect($trip->www($anchor));
    }
}
