<?php namespace Tests\Feature;

use App\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TripTest extends TestCase
{
    use DatabaseTransactions;

    public function testShow()
    {
        $trip = TripFactory::new()->create();

        $this->get("trips/{$trip->id}")
            ->assertRedirect($trip->www());
    }

    public function testShowWithAnchor()
    {
        $trip = TripFactory::new()->create();
        $anchor = '#anchor';

        $this->get("trips/{$trip->id}?anchor=" . urlencode($anchor))
            ->assertRedirect($trip->www($anchor));
    }
}
