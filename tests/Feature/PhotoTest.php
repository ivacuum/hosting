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

        $this->get('photos')
            ->assertStatus(200);
    }

    public function testCities()
    {
        $this->get('photos/cities')
            ->assertStatus(200);
    }

    public function testCity()
    {
        /** @var Photo $photo */
        $photo = factory(Photo::class)->state('trip')->create();

        $this->get("photos/cities/{$photo->rel->city->slug}")
            ->assertStatus(200);
    }

    public function testCountries()
    {
        $this->get('photos/countries')
            ->assertStatus(200);
    }

    public function testCountry()
    {
        /** @var Photo $photo */
        $photo = factory(Photo::class)->state('trip')->create();

        $this->get("photos/countries/{$photo->rel->city->country->slug}")
            ->assertStatus(200);
    }

    public function testFaq()
    {
        $this->get('photos/faq')
            ->assertStatus(200);
    }

    public function testMap()
    {
        $this->get('photos/map')
            ->assertStatus(200);
    }

    public function testTags()
    {
        factory(Photo::class)->states('tag', 'trip')->create();

        $this->get('photos/tags')
            ->assertStatus(200);
    }

    public function testTag()
    {
        /** @var Photo $photo */
        $photo = factory(Photo::class)->states('tag', 'trip')->create();

        $this->get("photos/tags/{$photo->tags[0]->id}")
            ->assertStatus(200);
    }

    public function testTrips()
    {
        factory(Trip::class)->states('city', 'meta_image')->create();

        $this->get('photos/trips')
            ->assertStatus(200);
    }

    public function testTrip()
    {
        /** @var Photo $photo */
        $photo = factory(Photo::class)->states('trip')->create();

        $this->get("photos/trips/{$photo->rel->id}")
            ->assertStatus(200);
    }
}
