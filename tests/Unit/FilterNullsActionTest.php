<?php

namespace Tests\Unit;

use App\Action\FilterNullsAction;
use Illuminate\Foundation\Testing\Attributes\UnitTest;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class FilterNullsActionTest extends TestCase
{
    #[UnitTest]
    public function testRecursivelyRemovesOnlyNullValues(): void
    {
        $result = new FilterNullsAction()->execute([
            'null' => null,
            'text' => 'string',
            'zero' => 0,
            'false' => false,
            'empty' => '',
            'nested' => ['null' => null, 'list' => [null, 'kept'], 'empty' => []],
        ]);

        $this->assertSame([
            'text' => 'string',
            'zero' => 0,
            'false' => false,
            'empty' => '',
            'nested' => ['list' => [1 => 'kept'], 'empty' => []],
        ], $result);
    }

    #[UnitTest]
    #[TestWith(['string', ['value' => 'string']], 'string')]
    #[TestWith([0, ['value' => 0]], 'zero')]
    #[TestWith([null, []], 'null')]
    #[TestWith([['null' => null, 'zero' => 0, 'empty' => []], ['value' => ['zero' => 0, 'empty' => []]]], 'nested array')]
    public function testSerializesValuesBeforeFiltering(mixed $value, array $expected): void
    {
        $serializable = new class($value) implements \JsonSerializable {
            public function __construct(private mixed $value) {}

            public function jsonSerialize(): mixed
            {
                return $this->value;
            }
        };

        $this->assertSame(
            ['nested' => $expected],
            new FilterNullsAction()->execute(['nested' => ['value' => $serializable]]),
        );
    }
}
