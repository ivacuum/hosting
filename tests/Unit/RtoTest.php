<?php

namespace Tests\Unit;

use App\Domain\Rto\Rto;
use App\Domain\Rto\RtoApiException;
use Tests\TestCase;

class RtoTest extends TestCase
{
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
        $this->expectExceptionMessage('Param [val] is over the limit of 50 (you sent 100 values)');
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
        $this->expectExceptionMessage('Invalid hash format');
        $this->expectExceptionCode(2);

        app(Rto::class)
            ->topicIdByHash('INVALID_HASH');
    }
}
