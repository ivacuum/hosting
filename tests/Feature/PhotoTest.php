<?php

namespace Tests\Feature;

use App\Domain\Life\Factory\CityFactory;
use App\Domain\Life\Factory\GigFactory;
use App\Domain\Life\Factory\PhotoFactory;
use App\Domain\Life\Factory\TagFactory;
use App\Domain\Life\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    use DatabaseTransactions;

    public function testCities()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get('photos/cities')
            ->assertOk()
            ->assertSee($photo->rel->city->title);
    }

    public function testCity()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("photos/cities/{$photo->rel->city->slug}")
            ->assertOk()
            ->assertSee($photo->rel->city->title);
    }

    public function testCityWithoutTrips()
    {
        $city = CityFactory::new()->create();

        $this->get("photos/cities/{$city->slug}")
            ->assertNotFound();
    }

    public function testCountries()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get('photos/countries')
            ->assertOk()
            ->assertSee($photo->rel->city->country->title);
    }

    public function testCountry()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("photos/countries/{$photo->rel->city->country->slug}")
            ->assertOk()
            ->assertSee($photo->rel->city->country->title);
    }

    public function testCountryWithoutTrips()
    {
        $city = CityFactory::new()->create();

        $this->get("photos/countries/{$city->country->slug}")
            ->assertNotFound();
    }

    public function testFaq()
    {
        $this->get('photos/faq')
            ->assertOk();
    }

    public function testIndex()
    {
        PhotoFactory::new()->withTrip()->create();

        $this->get('photos')
            ->assertOk();
    }

    public function testMap()
    {
        $this->get('photos/map')
            ->assertOk();
    }

    public function testMapPointAtEquator(): void
    {
        $photo = PhotoFactory::new()
            ->withPoint(0, 15)
            ->withTrip()
            ->create();

        $this->getJson("photos/map?trip_id={$photo->rel_id}")
            ->assertOk()
            ->assertJsonCount(1, 'features')
            ->assertJsonPath('features.0.id', $photo->id)
            ->assertJsonPath('features.0.geometry.coordinates', ['0', '15']);
    }

    public function testMapPointOfOnePhoto()
    {
        $photo = PhotoFactory::new()
            ->withPoint(5, 15)
            ->withTrip()
            ->create();

        $this->getJson("photos/map?trip_id={$photo->rel_id}&photo={$photo->slug}")
            ->assertOk()
            ->assertJsonPath('type', 'FeatureCollection')
            ->assertJsonPath('features.0.type', 'Feature')
            ->assertJsonPath('features.0.id', $photo->id)
            ->assertJsonPath('features.0.geometry.type', 'Point')
            ->assertJsonPath('features.0.geometry.coordinates.0', '5')
            ->assertJsonPath('features.0.geometry.coordinates.1', '15')
            ->assertJsonPath('features.0.properties.clusterCaption', basename($photo->slug));
    }

    public function testMapPointsOfAllTripsAndGigs(): void
    {
        $firstPhoto = PhotoFactory::new()->withPoint(5, 15)->withTrip()->create();
        $secondPhoto = PhotoFactory::new()->withPoint(25, 35)->withTrip()->create();
        $gigPhoto = PhotoFactory::new()->withPoint(45, 55)->withGig()->create();

        $this->getJson('photos/map')
            ->assertOk()
            ->assertJsonFragment(['id' => $firstPhoto->id])
            ->assertJsonFragment(['id' => $secondPhoto->id])
            ->assertJsonFragment(['id' => $gigPhoto->id])
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

    public function testMapPointsOfOneTrip(): void
    {
        $photo = PhotoFactory::new()
            ->withPoint(5, 15)
            ->withTrip()
            ->create();

        PhotoFactory::new()->withPoint(25, 35)->withTrip()->create();

        $this->getJson("photos/map?trip_id={$photo->rel_id}")
            ->assertOk()
            ->assertJsonCount(1, 'features')
            ->assertJsonPath('type', 'FeatureCollection')
            ->assertJsonPath('features.0.type', 'Feature')
            ->assertJsonPath('features.0.id', $photo->id)
            ->assertJsonPath('features.0.geometry.type', 'Point')
            ->assertJsonPath('features.0.geometry.coordinates.0', '5')
            ->assertJsonPath('features.0.geometry.coordinates.1', '15')
            ->assertJsonPath('features.0.properties.clusterCaption', basename($photo->slug));
    }

    public function testShowGigPhoto(): void
    {
        $gig = GigFactory::new()
            ->withDate('2025-03-14')
            ->withTitle('Концерт', 'Concert')
            ->create();

        $photo = PhotoFactory::new()
            ->withSlug('test/concert.jpg')
            ->withGig($gig)
            ->create();

        $this->get("photos/{$photo->id}")
            ->assertOk()
            ->assertViewHas('metaTitle', "Концерт, 14\u{00A0}марта 2025")
            ->assertSeeText("14\u{00A0}марта 2025")
            ->assertSee('src="https://life.ivacuum.org/gigs/test/concert.jpg"', false);
    }

    public function testTag()
    {
        $photo = PhotoFactory::new()
            ->withTag()
            ->withTrip()
            ->create();

        $this->get("photos/tags/{$photo->tags->first()->id}")
            ->assertOk()
            ->assertSee($photo->tags->first()->title);
    }

    public function testTags()
    {
        $publishedTag = TagFactory::new()
            ->withTitle('phpunit опубликованный тэг', 'phpunit published tag')
            ->create();

        $hiddenTag = TagFactory::new()
            ->withTitle('phpunit скрытый тэг', 'phpunit hidden tag')
            ->create();

        PhotoFactory::new()->withTag($publishedTag)->withTrip()->create();
        PhotoFactory::new()->hidden()->withTag($hiddenTag)->withTrip()->create();

        $this->get('photos/tags')
            ->assertOk()
            ->assertSee($publishedTag->title)
            ->assertDontSee($hiddenTag->title);
    }

    public function testTrip()
    {
        $photo = PhotoFactory::new()->withTrip()->create();

        $this->get("photos/trips/{$photo->rel->id}")
            ->assertOk()
            ->assertSee($photo->rel->title);
    }

    public function testTrips()
    {
        $trip = TripFactory::new()->metaImage()->create();

        $this->get('photos/trips')
            ->assertOk()
            ->assertSee($trip->title);
    }
}
