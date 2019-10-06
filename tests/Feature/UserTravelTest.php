<?php namespace Tests\Feature;

use App\Http\Controllers\UserTravelCities;
use App\Http\Controllers\UserTravelCountries;
use App\Http\Controllers\UserTravelTrips;
use App\Trip;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTravelTest extends TestCase
{
    use DatabaseTransactions;

    const LOGIN = '_test-user5';

    public function testCitiesIndex()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action([UserTravelCities::class, 'index'], self::LOGIN))
            ->assertStatus(200);
    }

    public function testCitiesShow()
    {
        /** @var User $user */
        /** @var Trip $trip */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action([UserTravelCities::class, 'show'], [self::LOGIN, $trip->city->slug]))
            ->assertStatus(200);
    }

    public function testCountriesIndex()
    {
        /** @var User $user */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action([UserTravelCountries::class, 'index'], self::LOGIN))
            ->assertStatus(200);
    }

    public function testCountriesShow()
    {
        /** @var User $user */
        /** @var Trip $trip */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action([UserTravelCountries::class, 'show'], [self::LOGIN, $trip->city->country->slug]))
            ->assertStatus(200);
    }

    public function testTripsIndex()
    {
        factory(User::class)->create(['login' => self::LOGIN]);

        $this->get(action([UserTravelTrips::class, 'index'], self::LOGIN))
            ->assertStatus(200);
    }

    public function testTripsShow()
    {
        /** @var User $user */
        /** @var Trip $trip */
        $user = factory(User::class)->create(['login' => self::LOGIN]);
        $trip = $user->trips()->save(factory(Trip::class)->state('city')->make());

        $this->get(action([UserTravelTrips::class, 'show'], [self::LOGIN, $trip->slug]))
            ->assertStatus(200);
    }
}
