<?php

namespace Tests\Unit;

use App\Domain\Japanese\Action\RomanizeHiraganaAction;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class RomanizeHiraganaActionTest extends TestCase
{
    #[TestWith(['ありがとう', 'arigatou'])]
    #[TestWith(['きょうと', 'kyouto'])]
    #[TestWith(['まっちゃ', 'matcha'])]
    #[TestWith(['コーヒー', 'koohii'])]
    #[TestWith(['エッフェルとう', 'efferutou'])]
    public function testRomanizesKana(string $kana, string $romaji): void
    {
        $this->assertSame(
            $romaji,
            $this->app
                ->make(RomanizeHiraganaAction::class)
                ->execute($kana)
        );
    }

    public function testRejectsUnknownCharacter(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $this->app->make(RomanizeHiraganaAction::class)->execute('〜じん');
    }
}
