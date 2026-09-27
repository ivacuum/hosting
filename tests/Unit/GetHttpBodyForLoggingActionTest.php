<?php

namespace Tests\Unit;

use App\Domain\Log\Action\GetHttpBodyForLoggingAction;
use GuzzleHttp\Psr7\FnStream;
use GuzzleHttp\Psr7\NoSeekStream;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Foundation\Testing\Attributes\UnitTest;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class GetHttpBodyForLoggingActionTest extends TestCase
{
    #[UnitTest]
    #[TestWith(['application/octet-stream', false], 'binary')]
    #[TestWith(['image/jpeg', false], 'image')]
    #[TestWith(['text/plain', true], 'explicitly skipped')]
    public function testLeavesExcludedBodiesUntouched(string $contentType, bool $skip): void
    {
        $stream = Utils::streamFor('body');
        $stream->seek(1);

        $this->assertSame('', new GetHttpBodyForLoggingAction()->execute($stream, $contentType, $skip));
        $this->assertSame(1, $stream->tell());
        $this->assertSame('ody', $stream->getContents());
    }

    #[UnitTest]
    public function testLeavesNonSeekableStreamsUntouched(): void
    {
        $stream = new NoSeekStream(Utils::streamFor('body'));

        $this->assertSame('', new GetHttpBodyForLoggingAction()->execute($stream, 'text/plain'));
        $this->assertSame('body', $stream->getContents());
    }

    #[UnitTest]
    public function testLeavesUnreadableStreamsUntouched(): void
    {
        $stream = FnStream::decorate(Utils::streamFor('body'), [
            'isReadable' => static fn (): bool => false,
        ]);

        $this->assertSame('', new GetHttpBodyForLoggingAction()->execute($stream, 'application/json'));
    }

    #[UnitTest]
    #[TestWith(["\xD0\xAF", "\xD0\xAF"], 'UTF-8 unchanged')]
    #[TestWith(["\xDF", "\xD0\xAF"], 'Windows-1251 converted')]
    #[TestWith(["\x98", 'Not valid UTF-8.'], 'invalid encoding rejected')]
    public function testNormalizesEncodingAndRestoresCursor(string $body, string $expected): void
    {
        $stream = Utils::streamFor($body);
        $stream->seek(1);

        $this->assertSame($expected, new GetHttpBodyForLoggingAction()->execute($stream, 'text/plain'));
        $this->assertSame(1, $stream->tell());
    }

    #[UnitTest]
    public function testReadsCompleteUtf8BodyAndRestoresCursor(): void
    {
        $body = str_repeat("\u{1F600}", 20_000);
        $stream = Utils::streamFor($body);
        $stream->seek(12);

        $this->assertSame($body, new GetHttpBodyForLoggingAction()->execute($stream, 'text/plain; charset=utf-8'));
        $this->assertSame(12, $stream->tell());
    }

    #[UnitTest]
    public function testRestoresCursorWhenReadingFails(): void
    {
        $stream = FnStream::decorate(Utils::streamFor('body'), [
            'getContents' => static fn (): never => throw new \RuntimeException('Read failed'),
        ]);
        $stream->seek(2);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Read failed');

        try {
            new GetHttpBodyForLoggingAction()->execute($stream, 'text/plain');
        } finally {
            $this->assertSame(2, $stream->tell());
        }
    }
}
