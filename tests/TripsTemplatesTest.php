<?php namespace Tests;

use App\TripFactory;
use App\User;

class TripsTemplatesTest extends TestCase
{
    public function testTripsTemplates()
    {
        $this->be(User::find(1));

        foreach (TripFactory::templatesIterator() as $template) {
            $this->get("/acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertStatus(200);
        }
    }
}
