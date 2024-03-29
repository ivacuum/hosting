<?php

namespace Tests\Feature;

use App\Action\FindGigTemplatesAction;
use App\Factory\GigFactory;
use App\Factory\UserFactory;
use Tests\TestCase;

class GigTemplatesTest extends TestCase
{
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
