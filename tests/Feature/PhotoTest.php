<?php namespace Tests\Feature;

use App\Http\Controllers\Photos;
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

        $this->get(action([Photos::class, 'index']))
            ->assertStatus(200);
    }

    public function testCities()
    {
        $this->get(action([Photos::class, 'cities']))
            ->assertStatus(200);
    }

    public function testCity()
    {
        /** @var Photo $photo */
        $photo = factory(Photo::class)->state('trip')->create();

        $this->get(action([Photos::class, 'city'], $photo->rel->city->slug))
            ->assertStatus(200);
    }

    public function testCountries()
    {
        $this->get(action([Photos::class, 'countries']))
            ->assertStatus(200);
    }

    public function testCountry()
    {
        /** @var Photo $photo */
        $photo = factory(Photo::class)->state('trip')->create();

        $this->get(action([Photos::class, 'country'], $photo->rel->city->country->slug))
            ->assertStatus(200);
    }

    public function testFaq()
    {
        $this->get(action([Photos::class, 'faq']))
            ->assertStatus(200);
    }

    public function testMap()
    {
        $this->get(action([Photos::class, 'map']))
            ->assertStatus(200);
    }

    public function testTags()
    {
        factory(Photo::class)->states('tag', 'trip')->create();

        $this->get(action([Photos::class, 'tags']))
            ->assertStatus(200);
    }

    public function testTag()
    {
        /** @var Photo $photo */
        $photo = factory(Photo::class)->states('tag', 'trip')->create();

        $this->get(action([Photos::class, 'tag'], $photo->tags->first()->id))
            ->assertStatus(200);
    }

    public function testTrips()
    {
        factory(Trip::class)->states('city', 'meta_image')->create();

        $this->get(action([Photos::class, 'trips']))
            ->assertStatus(200);
    }

    public function testTrip()
    {
        /** @var Photo $photo */
        $photo = factory(Photo::class)->states('trip')->create();

        $this->get(action([Photos::class, 'trip'], $photo->rel->id))
            ->assertStatus(200);
    }
}
