<?php

namespace Tests\Feature;

use App\Domain\Life\Action\FindGigTemplatesAction;
use App\Domain\Life\Factory\GigFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Collection;
use Tests\TestCase;

class GigTemplatesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testGigsTemplates(): void
    {
        GigFactory::new()->create();

        foreach (resolve(FindGigTemplatesAction::class)->execute() as $template) {
            $this->get("acp/dev/gig-templates/{$template->getBasename('.blade.php')}")
                ->assertOk();
        }
    }

    public function testList(): void
    {
        $this->mockTemplates();

        $this->get('acp/dev/gig-templates')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === ['draft']);
    }

    public function testListCanFilterTranslatedTemplates(): void
    {
        $this->mockTemplates();

        $this->get('acp/dev/gig-templates?finished=any&translated=1')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === ['finished']);
    }

    public function testListCanFilterUntranslatedTemplates(): void
    {
        $this->mockTemplates();

        $this->get('acp/dev/gig-templates?finished=any&translated=0')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === ['draft']);
    }

    public function testListCanShowAllTemplates(): void
    {
        $this->mockTemplates();

        $this->get('acp/dev/gig-templates?finished=any')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === [
                'draft',
                'finished',
            ]);
    }

    public function testListCanShowFinishedTemplates(): void
    {
        $this->mockTemplates();

        $this->get('acp/dev/gig-templates?finished=yes')
            ->assertOk()
            ->assertViewHas('templates', fn (Collection $templates) => $templates->pluck('name')->all() === ['finished']);
    }

    private function mockTemplates(): void
    {
        $draft = \Mockery::mock();
        $draft->allows('getBasename')->with('.blade.php')->andReturn('draft');
        $draft->expects('getContents')->andReturn("@ru\nТекст.\n@endru\n\nIMG_1234.jpeg\n");

        $finished = \Mockery::mock();
        $finished->allows('getBasename')->with('.blade.php')->andReturn('finished');
        $finished->expects('getContents')->andReturn("@ru\nТекст.\n@en\nText.\n@endru\n\n@include('tpl.pic-2x', ['pic' => 'IMG_1234.jpg'])\n");

        $this->mock(FindGigTemplatesAction::class)
            ->expects('execute')
            ->andReturn([$draft, $finished]);
    }
}
