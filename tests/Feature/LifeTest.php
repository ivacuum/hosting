<?php namespace Tests\Feature;

use App\Factory\GigFactory;
use App\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
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

    #[\PHPUnit\Framework\Attributes\DataProvider('pages')]
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

    public static function pages()
    {
        yield ['life/books'];
        yield ['life/chillout'];
        yield ['life/favorite-posts'];
        yield ['life/english'];
        yield ['life/german'];
        yield ['life/laundry'];
        yield ['life/movies'];
        yield ['life/podcasts'];
        yield ['life/using-in-travels'];
    }
}
