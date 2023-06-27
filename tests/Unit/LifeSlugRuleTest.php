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
        ArtistFactory::new()
            ->withSlug('phpunit-artist')
            ->create();

        CityFactory::new()
            ->withSlug('phpunit-city')
            ->create();

        GigFactory::new()
            ->withSlug('phpunit-gig')
            ->create();

        $trip = TripFactory::new()
            ->withSlug('phpunit-trip')
            ->create();

        $rules = ['slug' => LifeSlug::rules($trip)];

        $this->assertFalse(\Validator::make(['slug' => 'phpunit-artist'], $rules)->passes());
        $this->assertTrue(\Validator::make(['slug' => 'phpunit-artist-unknown'], $rules)->passes());

        $this->assertFalse(\Validator::make(['slug' => 'phpunit-city'], $rules)->passes());
        $this->assertTrue(\Validator::make(['slug' => 'phpunit-city-unknown'], $rules)->passes());

        $this->assertFalse(\Validator::make(['slug' => 'phpunit-gig'], $rules)->passes());
        $this->assertTrue(\Validator::make(['slug' => 'phpunit-gig-unknown'], $rules)->passes());

        $this->assertTrue(\Validator::make(['slug' => 'phpunit-trip'], $rules)->passes());
        $this->assertTrue(\Validator::make(['slug' => 'phpunit-trip-unknown'], $rules)->passes());
    }
}
