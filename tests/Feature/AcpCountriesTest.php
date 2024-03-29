<?php

namespace Tests\Feature;

use App\Factory\CountryFactory;
use App\Livewire\Acp\CountryForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpCountriesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testCreate()
    {
        $this->get('acp/countries/create')
            ->assertOk()
            ->assertSeeLivewire(CountryForm::class);
    }

    public function testEdit()
    {
        $country = CountryFactory::new()->create();

        $this->get("acp/countries/{$country->id}/edit")
            ->assertOk()
            ->assertSee($country->title)
            ->assertSeeLivewire(CountryForm::class);
    }

    public function testIndex()
    {
        CountryFactory::new()->create();

        $this->get('acp/countries')
            ->assertOk();
    }

    public function testShow()
    {
        $country = CountryFactory::new()->create();

        $this->get("acp/countries/{$country->id}")
            ->assertOk()
            ->assertSee($country->title);
    }

    public function testStore()
    {
        $country = CountryFactory::new()->make();

        \Livewire::test(CountryForm::class)
            ->set('slug', $country->slug)
            ->set('emoji', $country->emoji)
            ->set('titleEn', $country->title_en)
            ->set('titleRu', $country->title_ru)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/countries');

        $this->get('acp/countries')
            ->assertSee($country->title);
    }

    public function testUpdate()
    {
        $country = CountryFactory::new()->create();

        \Livewire::test(CountryForm::class, ['id' => $country->id])
            ->set('slug', 'country-slug')
            ->set('emoji', '🌚')
            ->set('titleEn', 'title en')
            ->set('titleRu', 'title ru')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/countries');

        $country->refresh();

        $this->assertSame('🌚', $country->emoji);
        $this->assertSame('title en', $country->title_en);
        $this->assertSame('title ru', $country->title_ru);
        $this->assertSame('country-slug', $country->slug);
    }
}
