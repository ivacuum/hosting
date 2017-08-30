<?php namespace Tests;

class TripsTemplatesTest extends TestCase
{
    public function testTripsTemplates()
    {
        $this->be(\App\User::find(1));

        foreach (\App\Trip::templatesIterator() as $template) {
            $this->get("/acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertStatus(200);
        }
    }
}
