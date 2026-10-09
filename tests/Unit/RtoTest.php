<?php

namespace Tests\Unit;

use App\Domain\Rto\Rto;
use App\Domain\Rto\RtoApiException;
use App\Domain\Rto\RtoFake;
use App\Domain\Rto\RtoTemporarilyUnavailableException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class RtoTest extends TestCase
{
    use DatabaseTransactions;

    #[TestWith(['12345', 12345], 'topic ID')]
    #[TestWith(['https://rutracker.org/forum/viewtopic.php?t=12345', 12345], 'topic URL')]
    #[TestWith(['12345.6', null], 'fractional ID')]
    #[TestWith(['https://rutracker.org/forum/viewtopic.php?t=12345.6', null], 'fractional URL ID')]
    #[TestWith(['0', null], 'zero ID')]
    public function testFindTopicIdRequiresPositiveInteger(string $input, int|null $expected): void
    {
        $this->assertSame($expected, app(Rto::class)->findTopicId($input));
    }

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
