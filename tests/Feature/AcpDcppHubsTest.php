<?php namespace Tests\Feature;

use App\Domain\DcppHubStatus;
use App\Factory\DcppHubFactory;
use App\Factory\UserFactory;
use App\Http\Livewire\Acp\DcppHubForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpDcppHubsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testCreate()
    {
        $this->get('acp/dcpp-hubs/create')
            ->assertOk()
            ->assertSeeLivewire(DcppHubForm::class);
    }

    public function testEdit()
    {
        $hub = DcppHubFactory::new()->create();

        $this->get("acp/dcpp-hubs/{$hub->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(DcppHubForm::class);
    }

    public function testIndex()
    {
        DcppHubFactory::new()->create();

        $this->get('acp/dcpp-hubs')
            ->assertOk();
    }

    public function testShow()
    {
        $hub = DcppHubFactory::new()->create();

        $this->get("acp/dcpp-hubs/{$hub->id}")
            ->assertOk();
    }

    public function testStore()
    {
        $hub = DcppHubFactory::new()->make();

        \Livewire::test(DcppHubForm::class)
            ->set('title', $hub->title)
            ->set('address', $hub->address)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/dcpp-hubs');

        $this->get('acp/dcpp-hubs')
            ->assertSee($hub->title);
    }

    public function testUpdate()
    {
        $hub = DcppHubFactory::new()->create();

        \Livewire::test(DcppHubForm::class, ['hub' => $hub])
            ->set('status', DcppHubStatus::Hidden->value)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/dcpp-hubs');

        $hub->refresh();

        $this->assertSame(DcppHubStatus::Hidden, $hub->status);
    }
}
