<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\Gig;
use Tests\TestCase;

class GigTemplatesTest extends TestCase
{
    public function testGigsTemplates()
    {
        $this->be(UserFactory::new()->admin()->make());

        foreach (Gig::templatesIterator() as $template) {
            $this->get("acp/dev/gig-templates/{$template->getBasename('.blade.php')}")
                ->assertStatus(200);
        }
    }
}
