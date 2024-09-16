<?php

namespace Tests\Feature;

use App\Domain\RateLimit;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RateLimitTest extends TestCase
{
    use DatabaseTransactions;

    public function testConfigValuesDoNotThrowException()
    {
        foreach (RateLimit::cases() as $case) {
            $case->get();
        }

        $this->expectNotToPerformAssertions();
    }
}
