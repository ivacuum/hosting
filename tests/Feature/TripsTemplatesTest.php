<?php namespace Tests\Feature;

use App\Action\FindTripTemplatesAction;
use App\Factory\UserFactory;
use Tests\TestCase;

class TripsTemplatesTest extends TestCase
{
    /** @slowThreshold 10000 */
    public function testTripsTemplates()
    {
        $this->be(UserFactory::new()->admin()->make());

        foreach (resolve(FindTripTemplatesAction::class)->execute() as $template) {
            $this->get("acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertStatus(200);
        }
    }
}
