<?php namespace Tests\Feature;

use App\Factory\CityFactory;
use App\Factory\PhotoFactory;
use App\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndex()
    {
        PhotoFactory::new()->withTrip()->create();

        $this->get('photos')
            ->assertStatus(200);
    }

    public function testCities()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get('photos/cities')
            ->assertStatus(200)
            ->assertSee($photo->rel->city->title);
    }

    public function testCity()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("photos/cities/{$photo->rel->city->slug}")
            ->assertStatus(200)
            ->assertSee($photo->rel->city->title);
    }

    public function testCityWithoutTrips()
    {
        $city = CityFactory::new()->withCountry()->create();

        $this->get("photos/cities/{$city->slug}")
            ->assertNotFound();
    }

    public function testCountries()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get('photos/countries')
            ->assertStatus(200)
            ->assertSee($photo->rel->city->country->title);
    }

    public function testCountry()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("photos/countries/{$photo->rel->city->country->slug}")
            ->assertStatus(200)
            ->assertSee($photo->rel->city->country->title);
    }

    public function testCountryWithoutTrips()
    {
        $city = CityFactory::new()->withCountry()->create();

        $this->get("photos/countries/{$city->country->slug}")
            ->assertNotFound();
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
        $photo = PhotoFactory::new()
            ->withTag()
            ->withTrip()
            ->create();

        $this->get('photos/tags')
            ->assertStatus(200)
            ->assertSee($photo->tags[0]->title);
    }

    public function testTag()
    {
        $photo = PhotoFactory::new()
            ->withTag()
            ->withTrip()
            ->create();

        $this->get("photos/tags/{$photo->tags[0]->id}")
            ->assertStatus(200)
            ->assertSee($photo->tags[0]->title);
    }

    public function testTrips()
    {
        $trip = TripFactory::new()->metaImage()->create();

        $this->get('photos/trips')
            ->assertStatus(200)
            ->assertSee($trip->title);
    }

    public function testTrip()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("photos/trips/{$photo->rel->id}")
            ->assertStatus(200)
            ->assertSee($photo->rel->title);
    }
}
