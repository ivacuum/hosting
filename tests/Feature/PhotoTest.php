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

    public function testMapPointsOfAllTrips()
    {
        PhotoFactory::new()->withTrip()->create();

        $this->getJson('photos/map')
            ->assertOk()
            ->assertJsonStructure([
                'type',
                'features' => [
                    '*' => [
                        'type',
                        'id',
                        'geometry' => [
                            'type',
                            'coordinates' => [0, 1],
                        ],
                        'properties' => [
                            'balloonContent',
                            'clusterCaption',
                        ],
                    ],
                ],
            ]);
    }

    public function testMapPointsOfOneTrips()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->getJson("photos/map?trip_id={$photo->rel_id}")
            ->assertOk()
            ->assertJsonPath('type', 'FeatureCollection')
            ->assertJsonPath('features.0.type', 'Feature')
            ->assertJsonPath('features.0.id', $photo->id)
            ->assertJsonPath('features.0.geometry.type', 'Point')
            ->assertJsonPath('features.0.geometry.coordinates.0', $photo->lat)
            ->assertJsonPath('features.0.geometry.coordinates.1', $photo->lon)
            ->assertJsonPath('features.0.properties.clusterCaption', basename($photo->slug));
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
