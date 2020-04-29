<?php namespace Tests\Feature;

use App\Factory\CountryFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpCountriesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/countries/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $country = CountryFactory::new()->create();

        $this->get("acp/countries/{$country->id}/edit")
            ->assertOk()
            ->assertSee($country->title);
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
        $this->post('acp/countries', CountryFactory::new()->make()->toArray())
            ->assertRedirect('acp/countries');
    }

    public function testUpdate()
    {
        $country = CountryFactory::new()->create();

        $this->put("acp/countries/{$country->id}", CountryFactory::new()->make()->toArray())
            ->assertRedirect('acp/countries');
    }
}
