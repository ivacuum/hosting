<?php namespace Tests\Feature;

use App\Factory\GigFactory;
use App\Gig;
use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LifeTest extends TestCase
{
    use DatabaseTransactions;

    public function testCalendar()
    {
        factory(Trip::class)->state('city')->create();

        $this->get('life/calendar')
            ->assertStatus(200);
    }

    public function testCities()
    {
        factory(Trip::class)->state('city')->create();

        $this->get('life/cities')
            ->assertStatus(200);
    }

    public function testCity()
    {
        /** @var Trip $trip */
        $trip = factory(Trip::class)->state('city')->create();

        $this->get("life/{$trip->city->slug}")
            ->assertStatus(200);
    }

    public function testCountries()
    {
        factory(Trip::class)->state('city')->create();

        $this->get('life/countries')
            ->assertStatus(200);
    }

    public function testCountry()
    {
        /** @var Trip $trip */
        $trip = factory(Trip::class)->state('city')->create();

        $this->get("life/countries/{$trip->city->country->slug}")
            ->assertStatus(200);
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
        factory(Trip::class)->state('city')->create();

        $this->get('life')
            ->assertStatus(200);
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
        /** @var Trip $trip */
        $trip = Trip::where('user_id', 1)
            ->where('status', Trip::STATUS_PUBLISHED)
            ->first();

        if (null !== $trip) {
            $this->get("life/{$trip->slug}")
                ->assertStatus(200);

            return;
        }

        $trip = factory(Trip::class)->state('city')->create();

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
