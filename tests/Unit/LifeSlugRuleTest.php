<?php

namespace Tests\Unit;

use App\Factory\ArtistFactory;
use App\Factory\CityFactory;
use App\Factory\GigFactory;
use App\Factory\TripFactory;
use App\Rules\LifeSlug;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class LifeSlugRuleTest extends TestCase
{
    use DatabaseTransactions;

    public function testUnique()
    {
        $artist = ArtistFactory::new()
            ->withSlug('phpunit-artist')
            ->create();

        $city = CityFactory::new()
            ->withSlug('phpunit-city')
            ->create();

        $gig = GigFactory::new()
            ->withSlug('phpunit-gig')
            ->create();

        $trip = TripFactory::new()
            ->withSlug('phpunit-trip')
            ->create();

        $this->assertFalse(\Validator::make(
            ['slug' => 'phpunit-artist'],
            ['slug' => LifeSlug::rules($trip)]
        )->passes());
        $this->assertTrue(\Validator::make(
            ['slug' => 'phpunit-artist-unknown'],
            ['slug' => LifeSlug::rules($trip)]
        )->passes());
        $this->assertTrue(\Validator::make(
            ['slug' => 'phpunit-artist'],
            ['slug' => LifeSlug::rules($artist)]
        )->passes());

        $this->assertFalse(\Validator::make(
            ['slug' => 'phpunit-city'],
            ['slug' => LifeSlug::rules($trip)]
        )->passes());
        $this->assertTrue(\Validator::make(
            ['slug' => 'phpunit-city-unknown'],
            ['slug' => LifeSlug::rules($trip)]
        )->passes());
        $this->assertTrue(\Validator::make(
            ['slug' => 'phpunit-city'],
            ['slug' => LifeSlug::rules($city)]
        )->passes());

        $this->assertFalse(\Validator::make(
            ['slug' => 'phpunit-gig'],
            ['slug' => LifeSlug::rules($trip)]
        )->passes());
        $this->assertTrue(\Validator::make(
            ['slug' => 'phpunit-gig-unknown'],
            ['slug' => LifeSlug::rules($trip)]
        )->passes());
        $this->assertTrue(\Validator::make(
            ['slug' => 'phpunit-gig'],
            ['slug' => LifeSlug::rules($gig)]
        )->passes());

        $this->assertTrue(\Validator::make(
            ['slug' => 'phpunit-trip'],
            ['slug' => LifeSlug::rules($trip)]
        )->passes());
        $this->assertTrue(\Validator::make(
            ['slug' => 'phpunit-trip-unknown'],
            ['slug' => LifeSlug::rules($trip)]
        )->passes());
        $this->assertFalse(\Validator::make(
            ['slug' => 'phpunit-trip'],
            ['slug' => LifeSlug::rules($artist)]
        )->passes());
    }
}
