<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTravelTest extends TestCase
{
    use DatabaseTransactions;

    const LOGIN = '_test-user5';

    public function testCitiesIndex()
    {
        $user = $this->user();
        $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get('@' . self::LOGIN . '/travel/cities')
            ->assertStatus(200);
    }

    public function testCitiesShow()
    {
        /** @var Trip $trip */
        $user = $this->user();
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get('@' . self::LOGIN . "/travel/cities/{$trip->city->slug}")
            ->assertStatus(200);
    }

    public function testCountriesIndex()
    {
        $user = $this->user();
        $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get('@' . self::LOGIN . '/travel/countries')
            ->assertStatus(200);
    }

    public function testCountriesShow()
    {
        /** @var Trip $trip */
        $user = $this->user();
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get('@' . self::LOGIN . "/travel/countries/{$trip->city->country->slug}")
            ->assertStatus(200);
    }

    public function testTripsIndex()
    {
        $this->user();

        $this->get('@' . self::LOGIN . '/travel')
            ->assertStatus(200);
    }

    public function testTripsShow()
    {
        /** @var Trip $trip */
        $user = $this->user();
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get('@' . self::LOGIN . "/travel/{$trip->slug}")
            ->assertStatus(200);
    }

    private function user()
    {
        return UserFactory::new()->withLogin(self::LOGIN)->create();
    }
}
