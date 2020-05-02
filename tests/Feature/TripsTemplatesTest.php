<?php namespace Tests\Feature;

use App\Factory\UserFactory;
use App\TripFactory;
use Tests\TestCase;

class TripsTemplatesTest extends TestCase
{
    public function testTripsTemplates()
    {
        $this->be(UserFactory::new()->admin()->make());

        foreach (TripFactory::templatesIterator() as $template) {
            $this->get("acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertStatus(200);
        }
    }
}
