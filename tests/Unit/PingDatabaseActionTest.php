<?php

namespace Tests\Unit;

use App\Action\PingDatabaseAction;
use Illuminate\Database\Connection;
use Illuminate\Foundation\Testing\Attributes\UnitTest;
use Illuminate\Support\Sleep;
use Tests\TestCase;

class PingDatabaseActionTest extends TestCase
{
    #[UnitTest]
    public function testWaitsUntilDatabaseIsBack(): void
    {
        Sleep::fake();

        $db = \Mockery::mock(Connection::class);
        $db->expects('statement')
            ->twice()
            ->with('DO 1')
            ->andThrow(new \PDOException('gone away'));
        $db->expects('statement')
            ->with('DO 1')
            ->andReturnTrue();
        $db->expects('reconnect')->twice();

        new PingDatabaseAction($db)->execute();

        Sleep::assertSequence([Sleep::for(5)->seconds()]);
    }
}
