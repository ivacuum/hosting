<?php

namespace Tests\Unit;

use App\Domain\Rto\Rto;
use App\Domain\Rto\RtoApiException;
use App\Domain\Rto\RtoFake;
use App\Domain\Rto\RtoTemporarilyUnavailableException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RtoTest extends TestCase
{
    use DatabaseTransactions;

    public function testTemporarilyDisabledErrorThrowsDedicatedException(): void
    {
        \Http::fake(RtoFake::topicDataByIdsTemporarilyUnavailable(911));

        $this->expectException(RtoTemporarilyUnavailableException::class);
        $this->expectExceptionMessageIs('Temporarily disabled');
        $this->expectExceptionCode(1);

        app(Rto::class)
            ->topicDataByIds([911]);
    }

    public function testTopicDataByIdsThrowsExceptionOnApiError(): void
    {
        \Http::fake(RtoFake::topicDataByIdsTooManyTopics());

        $this->expectException(RtoApiException::class);
        $this->expectExceptionMessageIs('Param [val] is over the limit of 50 (you sent 100 values)');
        $this->expectExceptionCode(1);

        app(Rto::class)
            ->topicDataByIds(range(1, 100));
    }

    public function testTopicIdByHashThrowsExceptionOnApiError(): void
    {
        \Http::fake(RtoFake::topicIdByHashInvalid('INVALID_HASH'));

        $this->expectException(RtoApiException::class);
        $this->expectExceptionMessageIs('Invalid hash format');
        $this->expectExceptionCode(2);

        app(Rto::class)
            ->topicIdByHash('INVALID_HASH');
    }
}
