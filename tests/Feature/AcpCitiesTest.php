<?php

namespace Tests\Feature;

use App\Factory\CityFactory;
use App\Factory\CountryFactory;
use App\Livewire\Acp\CityForm;
use App\Spatial\Point;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpCitiesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/cities/create')
            ->assertOk()
            ->assertSeeLivewire(CityForm::class);
    }

    public function testEdit()
    {
        $city = CityFactory::new()->create();

        $this->get("acp/cities/{$city->id}/edit")
            ->assertOk()
            ->assertSee($city->title)
            ->assertSeeLivewire(CityForm::class);
    }

    public function testIndex()
    {
        CityFactory::new()->create();

        $this->get('acp/cities')
            ->assertOk();
    }

    public function testShow()
    {
        $city = CityFactory::new()->create();

        $this->get("acp/cities/{$city->id}")
            ->assertOk()
            ->assertSee($city->title);
    }

    public function testStore()
    {
        $city = CityFactory::new()->make();

        \Livewire::test(CityForm::class)
            ->set('slug', $city->slug)
            ->set('titleEn', $city->title_en)
            ->set('titleRu', $city->title_ru)
            ->set('countryId', $city->country_id)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/cities');

        $this->get('acp/cities')
            ->assertSee($city->title);
    }

    public function testUpdate()
    {
        $city = CityFactory::new()->withPoint(new Point('5.55', '7.77'))->create();
        $country = CountryFactory::new()->create();

        \Livewire::test(CityForm::class, ['id' => $city->id])
            ->assertSet('lat', '5.55')
            ->assertSet('lon', '7.77')
            ->set('lat', '23.984')
            ->set('lon', '15.522')
            ->set('iata', 'LED')
            ->set('slug', 'city-slug')
            ->set('titleEn', 'title en')
            ->set('titleRu', 'title ru')
            ->set('countryId', $country->id)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/cities');

        $city->refresh();

        $this->assertSame('23.984', $city->point->lat);
        $this->assertSame('15.522', $city->point->lon);
        $this->assertSame('LED', $city->iata);
        $this->assertSame('city-slug', $city->slug);
        $this->assertSame('title en', $city->title_en);
        $this->assertSame('title ru', $city->title_ru);
        $this->assertSame($country->id, $city->country_id);
    }
}
