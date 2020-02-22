<?php namespace Tests\Feature;

use App\Factory\GigFactory;
use App\Factory\UserFactory;
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
        $gig = GigFactory::new()->create();

        $this->getJson("acp/gigs/{$gig->id}/edit")
            ->assertOk()
            ->assertJson(['model' => ['id' => $gig->id]]);
    }

    public function testIndex()
    {
        GigFactory::new()->create();

        $this->getJson('acp/gigs')
            ->assertOk();
    }

    public function testShow()
    {
        $gig = GigFactory::new()->create();

        $this->getJson("acp/gigs/{$gig->id}")
            ->assertOk()
            ->assertJson(['data' => ['id' => $gig->id]]);
    }

    public function testStore()
    {
        $this->postJson('acp/gigs', GigFactory::new()->make()->toArray())
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
        $gig = GigFactory::new()->create();

        $this->putJson("acp/gigs/{$gig->id}", GigFactory::new()->make()->toArray())
            ->assertOk()
            ->assertJson(['status' => 'OK']);
    }
}
