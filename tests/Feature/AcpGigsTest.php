<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Gig;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpGigsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/gigs/create')
            ->assertOk();
    }

    public function testEdit()
    {
        $gig = $this->createGig();

        $this->getJson("acp/gigs/{$gig->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $gig->id]]);
    }

    public function testIndex()
    {
        $this->createGig();

        $this->getJson('acp/gigs')
            ->assertOk();
    }

    public function testShow()
    {
        $gig = $this->createGig();

        $this->getJson("acp/gigs/{$gig->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $gig->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/gigs', factory(Gig::class)->state('city')->make()->toArray())
            ->assertCreated()
            ->assertLocation('acp/gigs');
    }

    public function testVue()
    {
        $this->get('acp/gigs')
            ->assertOk()
            ->assertViewIs('acp.index');
    }

    public function testUpdate()
    {
        $gig = $this->createGig();

        $this->putJson("acp/gigs/{$gig->id}", factory(Gig::class)->state('city')->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }

    private function createGig(): Gig
    {
        return factory(Gig::class)->state('city')->create();
    }
}
