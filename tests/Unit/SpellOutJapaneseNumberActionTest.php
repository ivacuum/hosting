<?php

namespace Tests\Unit;

use App\Domain\Japanese\Action\SpellOutJapaneseNumberAction;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class SpellOutJapaneseNumberActionTest extends TestCase
{
    #[TestWith([-1, 'まいなすいち'])]
    #[TestWith([0, 'ぜろ'])]
    #[TestWith([21, 'にじゅういち'])]
    #[TestWith([101, 'ひゃくいち'])]
    #[TestWith([300, 'さんびゃく'])]
    #[TestWith([600, 'ろっぴゃく'])]
    #[TestWith([800, 'はっぴゃく'])]
    #[TestWith([3000, 'さんぜん'])]
    #[TestWith([8000, 'はっせん'])]
    #[TestWith([9999, 'きゅうせんきゅうひゃくきゅうじゅうきゅう'])]
    #[TestWith([10001, 'いちまんいち'])]
    #[TestWith([100000001, 'いちおくいち'])]
    #[TestWith([1234567890, 'じゅうにおくさんぜんよんひゃくごじゅうろくまんななせんはっぴゃくきゅうじゅう'])]
    #[TestWith([999999999999, 'きゅうせんきゅうひゃくきゅうじゅうきゅうおくきゅうせんきゅうひゃくきゅうじゅうきゅうまんきゅうせんきゅうひゃくきゅうじゅうきゅう'])]
    public function testConvertsIntegerToHiragana(int $number, string $result): void
    {
        $this->assertSame(
            $result,
            $this->app
                ->make(SpellOutJapaneseNumberAction::class)
                ->execute($number)
        );
    }

    public function testRejectsUnsupportedMagnitude(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->app->make(SpellOutJapaneseNumberAction::class)->execute(1_000_000_000_000);
    }
}
