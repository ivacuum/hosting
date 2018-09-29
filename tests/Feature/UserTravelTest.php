<?php namespace Tests\Feature;

use App\Trip;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTravelTest extends TestCase
{
    use DatabaseTransactions;

    const LOGIN = '_test-user5';

    protected function setUp()
    {
        parent::setUp();

        \CityHelper::flush();
        \CountryHelper::flush();
    }

    public function testCitiesIndex()
    {
        /* @var User $user */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action('UserTravelCities@index', self::LOGIN))
            ->assertStatus(200);
    }

    public function testCitiesShow()
    {
        /* @var User $user */
        /* @var Trip $trip */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action('UserTravelCities@show', [self::LOGIN, $trip->city->slug]))
            ->assertStatus(200);
    }

    public function testCountriesIndex()
    {
        /* @var User $user */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action('UserTravelCountries@index', self::LOGIN))
            ->assertStatus(200);
    }

    public function testCountriesShow()
    {
        /* @var User $user */
        /* @var Trip $trip */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action('UserTravelCountries@show', [self::LOGIN, $trip->city->country->slug]))
            ->assertStatus(200);
    }

    public function testTripsIndex()
    {
        factory(User::class)->create(['login' => self::LOGIN]);

        $this->get(action('UserTravelTrips@index', self::LOGIN))
            ->assertStatus(200);
    }

    public function testTripsShow()
    {
        /* @var User $user */
        /* @var Trip $trip */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action('UserTravelTrips@show', [self::LOGIN, $trip->slug]))
            ->assertStatus(200);
    }
}
