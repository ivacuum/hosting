<?php

namespace Tests\Feature;

use App\Domain\Life\Action\FindGigTemplatesAction;
use App\Domain\Life\Factory\GigFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class GigTemplatesTest extends TestCase
{
    use DatabaseTransactions;

    public function testGigsTemplates()
    {
        $this->be(UserFactory::new()->admin()->make());

        GigFactory::new()->create();

        foreach (resolve(FindGigTemplatesAction::class)->execute() as $template) {
            $this->get("acp/dev/gig-templates/{$template->getBasename('.blade.php')}")
                ->assertOk();
        }
    }

    public function testList()
    {
        $this->be(UserFactory::new()->admin()->make());

        $this->get('acp/dev/gig-templates')->assertOk();
    }
}
