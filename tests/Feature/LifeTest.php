<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\GigFactory;
use App\Domain\Life\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class LifeTest extends TestCase
{
    use DatabaseTransactions;

    public function testCalendar()
    {
        // Две поездки и два города, потому что по city_id=1 в календаре исключается Калуга
        TripFactory::new()->create();
        TripFactory::new()->create();

        $this->get('life/calendar')
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testCities()
    {
        $trip = TripFactory::new()->create();

        $this->get('life/cities')
            ->assertOk()
            ->assertSee($trip->city->title)
            ->assertHasCustomTitle();
    }

    public function testCity()
    {
        $trip = TripFactory::new()->create();

        $this->get("life/{$trip->city->slug}")
            ->assertOk()
            ->assertSee($trip->city->title)
            ->assertHasCustomTitle();
    }

    public function testCountries()
    {
        $trip = TripFactory::new()->create();

        $this->get('life/countries')
            ->assertOk()
            ->assertSee($trip->city->country->title)
            ->assertHasCustomTitle();
    }

    public function testCountry()
    {
        $trip = TripFactory::new()->create();

        $this->get("life/countries/{$trip->city->country->slug}")
            ->assertOk()
            ->assertSee($trip->city->country->title)
            ->assertHasCustomTitle();
    }

    public function testGigs()
    {
        $gig = GigFactory::new()->create();

        $this->get('life/gigs')
            ->assertOk()
            ->assertSee($gig->artist->title)
            ->assertHasCustomTitle();
    }

    public function testGig()
    {
        $gig = GigFactory::new()->create();
        $gig->createStoryFile();

        $this->get("life/{$gig->slug}")
            ->assertOk()
            ->assertHasCustomTitle();

        $gig->deleteStoryFile();
    }

    public function testIndex()
    {
        $gig = GigFactory::new()->create();
        $trip = TripFactory::new()->create();

        $this->get('life')
            ->assertOk()
            ->assertSee($trip->title)
            ->assertSee($gig->artist->title)
            ->assertHasCustomTitle();
    }

    #[TestWith(['life/books'])]
    #[TestWith(['life/chillout'])]
    #[TestWith(['life/favorite-posts'])]
    #[TestWith(['life/english'])]
    #[TestWith(['life/german'])]
    #[TestWith(['life/laundry'])]
    #[TestWith(['life/movies'])]
    #[TestWith(['life/podcasts'])]
    #[TestWith(['life/using-in-travels'])]
    public function testPages(string $url)
    {
        $this->get($url)
            ->assertOk()
            ->assertHasCustomTitle();
    }

    public function testTrip()
    {
        $trip = TripFactory::new()->create();
        $trip->createStoryFile();

        $this->get("life/{$trip->slug}")
            ->assertOk()
            ->assertHasCustomTitle();

        $trip->deleteStoryFile();
    }
}
