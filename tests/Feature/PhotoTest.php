<?php namespace Tests\Feature;

use App\Photo;
use App\Trip;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        factory(Photo::class)->state('trip')->create();

        $this->get(action('Photos@index'))
            ->assertStatus(200);
    }

    public function testCities()
    {
        $this->get(action('Photos@cities'))
            ->assertStatus(200);
    }

    public function testCity()
    {
        /* @var Photo $photo */
        $photo = factory(Photo::class)->state('trip')->create();

        $this->get(action('Photos@city', $photo->rel->city->slug))
            ->assertStatus(200);
    }

    public function testCountries()
    {
        $this->get(action('Photos@countries'))
            ->assertStatus(200);
    }

    public function testCountry()
    {
        /* @var Photo $photo */
        $photo = factory(Photo::class)->state('trip')->create();

        $this->get(action('Photos@country', $photo->rel->city->country->slug))
            ->assertStatus(200);
    }

    public function testFaq()
    {
        $this->get(action('Photos@faq'))
            ->assertStatus(200);
    }

    public function testMap()
    {
        $this->get(action('Photos@map'))
            ->assertStatus(200);
    }

    public function testTags()
    {
        factory(Photo::class)->states('tag', 'trip')->create();

        $this->get(action('Photos@tags'))
            ->assertStatus(200);
    }

    public function testTag()
    {
        /* @var Photo $photo */
        $photo = factory(Photo::class)->states('tag', 'trip')->create();

        $this->get(action('Photos@tag', $photo->tags->first()->id))
            ->assertStatus(200);
    }

    public function testTrips()
    {
        factory(Trip::class)->states('city', 'meta_image')->create();

        $this->get(action('Photos@trips'))
            ->assertStatus(200);
    }

    public function testTrip()
    {
        /* @var Photo $photo */
        $photo = factory(Photo::class)->states('trip')->create();

        $this->get(action('Photos@trip', $photo->rel->id))
            ->assertStatus(200);
    }
}
