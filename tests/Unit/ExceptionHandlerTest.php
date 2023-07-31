<?php

namespace Tests\Unit;

use App\Action\GetTripsPublishedWithCoverAction;
use App\Exceptions\SkipDatabaseOffline;
use App\Exceptions\TelegramAnyException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Session\TokenMismatchException;
use Ivacuum\Generic\Jobs\SendTelegramMessageJob;
use Tests\TestCase;

class ExceptionHandlerTest extends TestCase
{
    use DatabaseTransactions;

    public function testReportSqlError()
    {
        $e = new QueryException('default', 'SELECT 1', [], new \Exception());

        $this->assertTrue(app(SkipDatabaseOffline::class)->__invoke($e));
    }

    public function testSkipWhenDatabaseOffline()
    {
        $e = new QueryException('default', 'SELECT 1', [], new \Exception('offline', 2002));

        $this->assertFalse(app(SkipDatabaseOffline::class)->__invoke($e));
    }

    public function testTelegramAnyException()
    {
        \Queue::fake();

        app(TelegramAnyException::class)
            ->__invoke(new \DomainException('Single one.', 111));

        \Queue::assertPushed(SendTelegramMessageJob::class, 1);
    }

    public function testTelegramAnyExceptionWithPrevious()
    {
        \Queue::fake();

        $previous = new \RuntimeException('Nothing to worry about.');

        app(TelegramAnyException::class)
            ->__invoke(new \DomainException('Best regards', 111, $previous));

        \Queue::assertPushed(SendTelegramMessageJob::class, 2);
    }

    public function testTokenMismatch()
    {
        $this->mock(GetTripsPublishedWithCoverAction::class)
            ->expects('execute')
            ->andThrow(new TokenMismatchException('Testing'));

        $this->from('about')
            ->get('/')
            ->assertRedirect('/about')
            ->assertSessionHas('message');
    }
}
