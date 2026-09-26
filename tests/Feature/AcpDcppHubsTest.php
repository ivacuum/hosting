<?php

namespace Tests\Feature;

use App\Domain\Dcpp\DcppHubStatus;
use App\Domain\Dcpp\Factory\DcppHubFactory;
use App\Livewire\Acp\DcppHubForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpDcppHubsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

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

    public function testStore(): void
    {
        \Livewire::test(DcppHubForm::class)
            ->set('title', 'phpunit hub')
            ->set('address', 'phpunit-hub.example.com')
            ->set('port', 1411)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/dcpp-hubs');

        $this->assertDatabaseHas('dcpp_hubs', [
            'title' => 'phpunit hub',
            'address' => 'phpunit-hub.example.com',
            'port' => 1411,
        ]);
    }

    public function testUpdate()
    {
        $hub = DcppHubFactory::new()->create();

        \Livewire::test(DcppHubForm::class, ['id' => $hub->id])
            ->set('status', DcppHubStatus::Hidden->value)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/dcpp-hubs');

        $hub->refresh();

        $this->assertSame(DcppHubStatus::Hidden, $hub->status);
    }
}
