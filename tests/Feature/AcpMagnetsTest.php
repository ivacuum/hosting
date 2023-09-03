<?php

namespace Tests\Feature;

use App\Domain\MagnetStatus;
use App\Factory\MagnetFactory;
use App\Livewire\Acp\MagnetForm;
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

        \Livewire::test(MagnetForm::class, ['id' => $magnet->id])
            ->set('status', MagnetStatus::Deleted->value)
            ->set('relatedQuery', 'example')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirect('/acp/magnets');

        $magnet->refresh();

        $this->assertSame('example', $magnet->related_query);
        $this->assertSame(MagnetStatus::Deleted, $magnet->status);
    }
}
