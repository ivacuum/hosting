<?php

namespace Tests\Feature;

use App\Domain\Life\Action\FindTripTemplatesAction;
use App\Domain\Life\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class TripsTemplatesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testListAndFilters()
    {
        $this->mockTemplates();

        $this->get('acp/dev/templates')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === ['draft']);
    }

    public function testListCanFilterTranslatedTemplates()
    {
        $this->mockTemplates();

        $this->get('acp/dev/templates?finished=any&translated=1')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === ['finished']);
    }

    public function testListCanFilterUntranslatedTemplates()
    {
        $this->mockTemplates();

        $this->get('acp/dev/templates?finished=any&translated=0')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === ['draft']);
    }

    public function testListCanShowAllTemplates()
    {
        $this->mockTemplates();

        $this->get('acp/dev/templates?finished=any')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === [
                'draft',
                'finished',
            ]);
    }

    public function testListCanShowFinishedTemplates()
    {
        $this->mockTemplates();

        $this->get('acp/dev/templates?finished=yes')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === ['finished']);
    }

    /** @slowThreshold 10000 */
    public function testTripsTemplates()
    {
        TripFactory::new()->create();

        foreach (resolve(FindTripTemplatesAction::class)->execute() as $template) {
            $this->get("acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertOk();
        }
    }

    private function mockTemplates(): void
    {
        $draft = \Mockery::mock();
        $draft->allows('getBasename')->with('.blade.php')->andReturn('draft');
        $draft->expects('getContents')->andReturn("@ru\nТекст.\n@endru\n\nIMG_1234.jpeg\n");

        $finished = \Mockery::mock();
        $finished->allows('getBasename')->with('.blade.php')->andReturn('finished');
        $finished->expects('getContents')->andReturn("@ru\nТекст.\n@en\nText.\n@endru\n\n@include('tpl.pic-2x', ['pic' => 'IMG_1234.jpg'])\n");

        $this->mock(FindTripTemplatesAction::class)
            ->expects('execute')
            ->andReturn([$draft, $finished]);
    }
}
