<?php

namespace Tests\Feature;

use App\Domain\Magnet\Factory\MagnetFactory;
use App\Domain\Magnet\MagnetStatus;
use App\Livewire\Acp\MagnetForm;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpMagnetsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testEdit(): void
    {
        $magnet = MagnetFactory::new()->create();

        $this->get("acp/magnets/{$magnet->id}/edit")
            ->assertOk()
            ->assertSeeLivewire(MagnetForm::class);
    }

    public function testIndex(): void
    {
        MagnetFactory::new()->create();

        $this->get('acp/magnets')
            ->assertOk();
    }

    public function testShow(): void
    {
        $magnet = MagnetFactory::new()->create();

        $this->get("acp/magnets/{$magnet->id}")
            ->assertOk();
    }

    public function testUpdate(): void
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
