<?php

namespace Tests\Feature;

use App\Domain\MagnetStatus;
use App\Factory\MagnetFactory;
use App\Http\Livewire\Acp\MagnetForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpMagnetsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testEdit()
    {
        $magnet = MagnetFactory::new()->create();

        $this->get("acp/magnets/{$magnet->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(MagnetForm::class);
    }

    public function testIndex()
    {
        MagnetFactory::new()->create();

        $this->get('acp/magnets')
            ->assertOk();
    }

    public function testShow()
    {
        $magnet = MagnetFactory::new()->create();

        $this->get("acp/magnets/{$magnet->id}")
            ->assertOk();
    }

    public function testUpdate()
    {
        $magnet = MagnetFactory::new()->create();

        \Livewire::test(MagnetForm::class, ['magnet' => $magnet])
            ->set('magnet.status', MagnetStatus::Deleted)
            ->set('magnet.related_query', 'example')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/magnets');

        $magnet->refresh();

        $this->assertSame('example', $magnet->related_query);
        $this->assertSame(MagnetStatus::Deleted, $magnet->status);
    }
}
