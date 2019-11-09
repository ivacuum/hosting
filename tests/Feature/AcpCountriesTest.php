<?php namespace Tests\Feature;

use App\Country;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpCountriesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(User::find(1));
    }

    public function testCreate()
    {
        $this->get('acp/countries/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $city = $this->createCountry();

        $this->getJson("acp/countries/{$city->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $city->id]]);
    }

    public function testIndex()
    {
        $this->createCountry();

        $this->getJson('acp/countries')
            ->assertOk();
    }

    public function testShow()
    {
        $countries = $this->createCountry();

        $this->getJson("acp/countries/{$countries->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $countries->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/countries', factory(Country::class)->make()->toArray())
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
        $country = $this->createCountry();

        $this->putJson("acp/countries/{$country->id}", factory(Country::class)->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }

    private function createCountry(): Country
    {
        return factory(Country::class)->create();
    }
}
