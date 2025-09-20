<?php

namespace Tests\Unit;

use App\Domain\Japanese\Action\HiraganizeJapaneseNumberAction;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class HiraganizeJapaneseNumberActionTest extends TestCase
{
    #[TestWith([0, 'ぜろ'])]
    #[TestWith([300, 'さんびゃく'])]
    #[TestWith([600, 'ろっぴゃく'])]
    #[TestWith([800, 'はっぴゃく'])]
    #[TestWith([9999, 'きゅうせんきゅうひゃくきゅうじゅうきゅう'])]
    #[TestWith([1234567890, 'じゅうにおくさんせんよんひゃくごじゅうろくまんななせんはっぴゃくきゅうじゅう'])]
    public function testEn(int $number, string $result)
    {
        $formatter = new \NumberFormatter('ja', \NumberFormatter::SPELLOUT);

        $this->assertSame(
            $result,
            $this->app
                ->make(HiraganizeJapaneseNumberAction::class)
                ->execute($formatter->format($number))
        );
    }
}
