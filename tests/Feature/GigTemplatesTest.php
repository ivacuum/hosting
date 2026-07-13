<?php

namespace Tests\Feature;

use App\Domain\Life\Action\FindGigTemplatesAction;
use App\Domain\Life\Factory\GigFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GigTemplatesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testGigsTemplates()
    {
        GigFactory::new()->create();

        foreach (resolve(FindGigTemplatesAction::class)->execute() as $template) {
            $this->get("acp/dev/gig-templates/{$template->getBasename('.blade.php')}")
                ->assertOk();
        }
    }

    public function testList()
    {
        $this->get('acp/dev/gig-templates')->assertOk();
    }
}
