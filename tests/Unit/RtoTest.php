<?php

namespace Tests\Unit;

use App\Domain\Rto\Rto;
use App\Domain\Rto\RtoApiException;
use App\Domain\Rto\RtoTemporarilyUnavailableException;
use Tests\TestCase;

class RtoTest extends TestCase
{
    public function testTemporarilyDisabledErrorThrowsDedicatedExceptionAndRecordsMetric(): void
    {
        \Http::fake([
            'api-rto.vacuum.name/v1/get_tor_topic_data*' => \Http::response([
                'error' => [
                    'code' => 1,
                    'text' => 'Temporarily disabled',
                ],
            ]),
        ]);

        $this->expectException(RtoTemporarilyUnavailableException::class);
        $this->expectExceptionMessageIs('Temporarily disabled');
        $this->expectExceptionCode(1);

        app(Rto::class)
            ->topicDataByIds([911]);
    }

    public function testTopicDataByIdsThrowsExceptionOnApiError(): void
    {
        \Http::fake([
            'api-rto.vacuum.name/v1/get_tor_topic_data*' => \Http::response([
                'error' => [
                    'code' => 1,
                    'text' => 'Param [val] is over the limit of 50 (you sent 100 values)',
                ],
            ]),
        ]);

        $this->expectException(RtoApiException::class);
        $this->expectExceptionMessageIs('Param [val] is over the limit of 50 (you sent 100 values)');
        $this->expectExceptionCode(1);

        app(Rto::class)
            ->topicDataByIds(range(1, 100));
    }

    public function testTopicIdByHashThrowsExceptionOnApiError(): void
    {
        \Http::fake([
            'api-rto.vacuum.name/v1/get_topic_id*' => \Http::response([
                'error' => [
                    'code' => 2,
                    'text' => 'Invalid hash format',
                ],
            ]),
        ]);

        $this->expectException(RtoApiException::class);
        $this->expectExceptionMessageIs('Invalid hash format');
        $this->expectExceptionCode(2);

        app(Rto::class)
            ->topicIdByHash('INVALID_HASH');
    }
}
