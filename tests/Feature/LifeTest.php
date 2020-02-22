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
        TripFactory::new()->create();

        $this->get('life/calendar')
            ->assertStatus(200);
    }

    public function testCities()
    {
        $trip = TripFactory::new()->create();

        $this->get('life/cities')
            ->assertStatus(200)
            ->assertSee($trip->city->title);
    }

    public function testCity()
    {
        $trip = TripFactory::new()->create();

        $this->get("life/{$trip->city->slug}")
            ->assertStatus(200)
            ->assertSee($trip->city->title);
    }

    public function testCountries()
    {
        $trip = TripFactory::new()->create();

        $this->get('life/countries')
            ->assertStatus(200)
            ->assertSee($trip->city->country->title);
    }

    public function testCountry()
    {
        $trip = TripFactory::new()->create();

        $this->get("life/countries/{$trip->city->country->slug}")
            ->assertStatus(200)
            ->assertSee($trip->city->country->title);
    }

    public function testGigs()
    {
        $gig = GigFactory::new()->create();

        $this->get('life/gigs')
            ->assertStatus(200)
            ->assertSee($gig->artist->title);
    }

    public function testGig()
    {
        $gig = GigFactory::new()->create();
        $gig->createStoryFile();

        $this->get("life/{$gig->slug}")
            ->assertStatus(200);

        $gig->deleteStoryFile();
    }

    public function testIndex()
    {
        $trip = TripFactory::new()->create();

        $this->get('life')
            ->assertStatus(200)
            ->assertSee($trip->title);
    }

    /**
     * @dataProvider pages
     * @param string $url
     */
    public function testPages(string $url)
    {
        $this->get($url)->assertStatus(200);
    }

    public function testTrip()
    {
        $trip = TripFactory::new()->create();
        $trip->createStoryFile();

        $this->get("life/{$trip->slug}")
            ->assertStatus(200);

        $trip->deleteStoryFile();
    }

    public function pages()
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
