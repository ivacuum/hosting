<?php

namespace Tests\Feature;

use App\Action\FindTripTemplatesAction;
use App\Factory\TripFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TripsTemplatesTest extends TestCase
{
    use DatabaseTransactions;

    /** @slowThreshold 10000 */
    public function testTripsTemplates()
    {
        $this->be(UserFactory::new()->admin()->make());

        TripFactory::new()->create();

        foreach (resolve(FindTripTemplatesAction::class)->execute() as $template) {
            $this->get("acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertOk();
        }
    }

    public function testList()
    {
        $this->be(UserFactory::new()->admin()->make());

        $this->get('acp/dev/templates')->assertOk();
    }
}
