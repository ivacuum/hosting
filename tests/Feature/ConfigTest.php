<?php

namespace Feature;

use App\Domain\Config;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ConfigTest extends TestCase
{
    use DatabaseTransactions;

    public function testConfigValuesDoNotThrowException()
    {
        foreach (Config::cases() as $case) {
            $case->get();
        }

        $this->expectNotToPerformAssertions();
    }
}
