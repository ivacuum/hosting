<?php

namespace Tests\Unit;

use App\Exceptions\SkipDatabaseOffline;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ExceptionHandlerTest extends TestCase
{
    use DatabaseTransactions;

    public function testReportSqlError()
    {
        $e = new QueryException('default', 'SELECT 1', [], new \Exception);

        $this->assertTrue(app(SkipDatabaseOffline::class)->__invoke($e));
    }

    public function testSkipWhenDatabaseOffline()
    {
        $e = new QueryException('default', 'SELECT 1', [], new \Exception('offline', 2002));

        $this->assertFalse(app(SkipDatabaseOffline::class)->__invoke($e));
    }
}
