<?php namespace Tests\Feature;

use App\Gig;
use App\Http\Controllers\Life;
use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LifeTest extends TestCase
{
    use DatabaseTransactions;

    public function testCalendar()
    {
        factory(Trip::class)->state('city')->create();

        $this->get(action([Life::class, 'calendar']))
            ->assertStatus(200);
    }

    public function testCities()
    {
        factory(Trip::class)->state('city')->create();

        $this->get(action([Life::class, 'cities']))
            ->assertStatus(200);
    }

    public function testCity()
    {
        /** @var Trip $trip */
        $trip = factory(Trip::class)->state('city')->create();

        $this->get($trip->city->www())
            ->assertStatus(200);
    }

    public function testCountries()
    {
        factory(Trip::class)->state('city')->create();

        $this->get(action([Life::class, 'countries']))
            ->assertStatus(200);
    }

    public function testCountry()
    {
        /** @var Trip $trip */
        $trip = factory(Trip::class)->state('city')->create();

        $this->get($trip->city->country->www())
            ->assertStatus(200);
    }

    public function testGigs()
    {
        factory(Gig::class)->state('city')->create();

        $this->get(action([Life::class, 'gigs']))
            ->assertStatus(200);
    }

    public function testGig()
    {
        /** @var Gig $gig */
        $gig = Gig::where('status', Gig::STATUS_PUBLISHED)->first();

        if (null !== $gig) {
            $this->get($gig->www())
                ->assertStatus(200);

            return;
        }

        $gig = factory(Gig::class)->state('city')->create();

        $gig->createStoryFile();

        $this->get($gig->www())
            ->assertStatus(200);

        $gig->deleteStoryFile();
    }

    public function testIndex()
    {
        factory(Trip::class)->state('city')->create();

        $this->get(action([Life::class, 'index']))
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
            $this->get($trip->www())
                ->assertStatus(200);

            return;
        }

        $trip = factory(Trip::class)->state('city')->create();

        $trip->createStoryFile();

        $this->get($trip->www())
            ->assertStatus(200);

        $trip->deleteStoryFile();
    }

    public function pages()
    {
        return [
            ['/life/books'],
            ['/life/chillout'],
            ['/life/favorite-posts'],
            ['/life/english'],
            ['/life/german'],
            ['/life/laundry'],
            ['/life/movies'],
            ['/life/podcasts'],
            ['/life/using-in-travels'],
        ];
    }
}
