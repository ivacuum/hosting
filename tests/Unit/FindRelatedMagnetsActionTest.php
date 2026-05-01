<?php

namespace Tests\Unit;

use App\Domain\Magnet\Action\FindRelatedMagnetsAction;
use App\Domain\Magnet\Factory\MagnetFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class FindRelatedMagnetsActionTest extends TestCase
{
    use DatabaseTransactions;

    public function testExecuteReturnsEmptyArrayWhenNoRelatedQuery()
    {
        $magnet = MagnetFactory::new()
            ->withRelatedQuery('')
            ->create();

        $findRelatedMagnets = app(FindRelatedMagnetsAction::class);

        $this->assertSame([], $findRelatedMagnets->execute($magnet));
    }

    public function testExecuteReturnsRelatedIdsAndExcludesSelf()
    {
        config(['scout.driver' => 'collection']);

        $magnet = MagnetFactory::new()
            ->withTitle('Hitman Episode 4')
            ->withRelatedQuery('Hitman')
            ->create();

        $related = MagnetFactory::new()
            ->withTitle('Hitman 3')
            ->create();

        $unrelated = MagnetFactory::new()
            ->withTitle('Fireman')
            ->create();

        $findRelatedMagnets = app(FindRelatedMagnetsAction::class);

        $ids = $findRelatedMagnets->execute($magnet);

        $this->assertContains($related->id, $ids);
        $this->assertNotContains($unrelated->id, $ids);
        $this->assertNotContains($magnet->id, $ids);
    }
}
