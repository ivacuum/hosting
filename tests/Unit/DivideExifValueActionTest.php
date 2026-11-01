<?php

namespace Tests\Unit;

use App\Domain\Exif\DivideExifValueAction;
use Illuminate\Foundation\Testing\Attributes\UnitTest;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class DivideExifValueActionTest extends TestCase
{
    #[UnitTest]
    #[TestWith(['4622/100', 46.22])]
    #[TestWith(['0/1', 0])]
    #[TestWith(['5/0', null])]
    #[TestWith(['abc/100', null])]
    #[TestWith(['5', null])]
    public function testDivide(string $value, float|int|null $expected): void
    {
        $this->assertSame($expected, new DivideExifValueAction()->execute($value));
    }
}
