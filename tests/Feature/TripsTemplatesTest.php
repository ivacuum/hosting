<?php

namespace Tests\Feature;

use App\Domain\Life\Action\FindTripTemplatesAction;
use App\Domain\Life\Factory\TripFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TripsTemplatesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    /** @slowThreshold 10000 */
    public function testTripsTemplates()
    {
        TripFactory::new()->create();

        foreach (resolve(FindTripTemplatesAction::class)->execute() as $template) {
            $this->get("acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertOk();
        }
    }

    public function testList()
    {
        $this->get('acp/dev/templates')->assertOk();
    }
}
