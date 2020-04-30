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

        $this->get("acp/gigs/{$gig->id}/edit")
            ->assertOk()
            ->assertSee($gig->title);
    }

    public function testIndex()
    {
        GigFactory::new()->create();

        $this->get('acp/gigs')
            ->assertOk();
    }

    public function testShow()
    {
        $gig = GigFactory::new()->create();

        $this->get("acp/gigs/{$gig->id}")
            ->assertOk()
            ->assertSee($gig->title);
    }

    public function testStore()
    {
        $this->post('acp/gigs', GigFactory::new()->make()->toArray())
            ->assertRedirect('acp/gigs');
    }

    public function testUpdate()
    {
        $gig = GigFactory::new()->create();

        $this->put("acp/gigs/{$gig->id}", GigFactory::new()->make()->toArray())
            ->assertRedirect('acp/gigs');
    }
}
