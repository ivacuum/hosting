<?php namespace Tests\Feature;

use App\Factory\TripFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTravelTest extends TestCase
{
    use DatabaseTransactions;

    private const LOGIN = '_test-user5';

    public function testCitiesIndex()
    {
        $trip = TripFactory::new()->make();
        $this->user()->trips()->save($trip);

        $this->get('@' . self::LOGIN . '/travel/cities')
            ->assertStatus(200)
            ->assertSee($trip->city->title);
    }

    public function testCitiesShow()
    {
        $trip = TripFactory::new()->make();
        $this->user()->trips()->save($trip);

        $this->get('@' . self::LOGIN . "/travel/cities/{$trip->city->slug}")
            ->assertStatus(200)
            ->assertSee($trip->city->title);
    }

    public function testCountriesIndex()
    {
        $trip = TripFactory::new()->make();
        $this->user()->trips()->save($trip);

        $this->get('@' . self::LOGIN . '/travel/countries')
            ->assertStatus(200)
            ->assertSee($trip->city->country->title);
    }

    public function testCountriesShow()
    {
        $trip = TripFactory::new()->make();
        $this->user()->trips()->save($trip);

        $this->get('@' . self::LOGIN . "/travel/countries/{$trip->city->country->slug}")
            ->assertStatus(200)
            ->assertSee($trip->city->country->title);
    }

    public function testTripsIndex()
    {
        $trip = TripFactory::new()->make();
        $this->user()->trips()->save($trip);

        $this->get('@' . self::LOGIN . '/travel')
            ->assertStatus(200)
            ->assertSee($trip->title);
    }

    public function testTripsShow()
    {
        $trip = TripFactory::new()->make();
        $this->user()->trips()->save($trip);

        $this->get('@' . self::LOGIN . "/travel/{$trip->slug}")
            ->assertStatus(200)
            ->assertSee($trip->title);
    }

    private function user()
    {
        return UserFactory::new()->withLogin(self::LOGIN)->create();
    }
}
