<?php

namespace Tests\Unit;

use App\Action\HiraganizeJapaneseNumberAction;
use Tests\TestCase;

class HiraganizeJapaneseNumberActionTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\DataProvider('numbers')]
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

    public static function numbers()
    {
        yield [0, 'ぜろ'];
        yield [300, 'さんびゃく'];
        yield [600, 'ろっぴゃく'];
        yield [800, 'はっぴゃく'];
        yield [9999, 'きゅうせんきゅうひゃくきゅうじゅうきゅう'];
        yield [1234567890, 'じゅうにおくさんせんよんひゃくごじゅうろくまんななせんはっぴゃくきゅうじゅう'];
    }
}
