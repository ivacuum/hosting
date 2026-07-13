<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\TripFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTravelTest extends TestCase
{
    use DatabaseTransactions;

    public function testCitiesIndex()
    {
        $trip = TripFactory::new()
            ->withUser(UserFactory::new()->withLogin('phpunit-user'))
            ->create();

        $this->get('@phpunit-user/travel/cities')
            ->assertOk()
            ->assertSee($trip->city->title);
    }

    public function testCitiesShow()
    {
        $trip = TripFactory::new()
            ->withUser(UserFactory::new()->withLogin('phpunit-user'))
            ->create();

        $this->get("@phpunit-user/travel/cities/{$trip->city->slug}")
            ->assertOk()
            ->assertSee($trip->city->title);
    }

    public function testCountriesIndex()
    {
        $trip = TripFactory::new()
            ->withUser(UserFactory::new()->withLogin('phpunit-user'))
            ->create();

        $this->get('@phpunit-user/travel/countries')
            ->assertOk()
            ->assertSee($trip->city->country->title);
    }

    public function testCountriesShow()
    {
        $trip = TripFactory::new()
            ->withUser(UserFactory::new()->withLogin('phpunit-user'))
            ->create();

        $this->get("@phpunit-user/travel/countries/{$trip->city->country->slug}")
            ->assertOk()
            ->assertSee($trip->city->country->title);
    }

    public function testTripsIndex()
    {
        $trip = TripFactory::new()
            ->withUser(UserFactory::new()->withLogin('phpunit-user'))
            ->create();

        $this->get('@phpunit-user/travel')
            ->assertOk()
            ->assertSee($trip->title);
    }

    public function testTripsShow()
    {
        $trip = TripFactory::new()
            ->withUser(UserFactory::new()->withLogin('phpunit-user'))
            ->withSlug('phpunit-trip')
            ->create();

        $this->get('@phpunit-user/travel/phpunit-trip')
            ->assertOk()
            ->assertSee($trip->title);
    }
}
