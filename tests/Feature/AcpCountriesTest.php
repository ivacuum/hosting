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

        $this->getJson("acp/countries/{$country->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $country->id]]);
    }

    public function testIndex()
    {
        CountryFactory::new()->create();

        $this->getJson('acp/countries')
            ->assertOk();
    }

    public function testShow()
    {
        $countries = CountryFactory::new()->create();

        $this->getJson("acp/countries/{$countries->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $countries->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/countries', CountryFactory::new()->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/countries');
    }

    public function testVue()
    {
        $this->get('acp/countries')
            ->assertOk()
            ->assertViewIs('acp.index');
    }

    public function testUpdate()
    {
        $country = CountryFactory::new()->create();

        $this->putJson("acp/countries/{$country->id}", CountryFactory::new()->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }
}
