<?php

namespace Tests\Unit;

use App\Domain\Log\Action\GetHttpBodyForLoggingAction;
use GuzzleHttp\Psr7\Utils;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

class GetHttpBodyForLoggingActionTest extends TestCase
{
    #[TestWith(['application/octet-stream'])]
    #[TestWith(['image/jpeg'])]
    public function testLeavesBinaryStreamsUntouched(string $contentType): void
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('isReadable')->willReturn(true);
        $stream->method('isSeekable')->willReturn(true);
        $stream->expects($this->never())->method('tell');
        $stream->expects($this->never())->method('rewind');
        $stream->expects($this->never())->method('read');
        $stream->expects($this->never())->method('getContents');
        $stream->expects($this->never())->method('seek');

        $this->assertSame('', new GetHttpBodyForLoggingAction()->execute($stream, $contentType));
    }

    public function testLeavesNonSeekableStreamsUntouched(): void
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('isReadable')->willReturn(true);
        $stream->method('isSeekable')->willReturn(false);
        $stream->expects($this->never())->method('tell');
        $stream->expects($this->never())->method('rewind');
        $stream->expects($this->never())->method('read');
        $stream->expects($this->never())->method('getContents');
        $stream->expects($this->never())->method('seek');

        $this->assertSame('', new GetHttpBodyForLoggingAction()->execute($stream, 'text/plain'));
    }

    public function testLeavesSkippedStreamsUntouched(): void
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('isReadable')->willReturn(true);
        $stream->method('isSeekable')->willReturn(true);
        $stream->expects($this->never())->method('tell');
        $stream->expects($this->never())->method('rewind');
        $stream->expects($this->never())->method('read');
        $stream->expects($this->never())->method('getContents');
        $stream->expects($this->never())->method('seek');

        $this->assertSame('', new GetHttpBodyForLoggingAction()->execute($stream, 'text/plain', skip: true));
    }

    public function testLeavesUnreadableStreamsUntouched(): void
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('isReadable')->willReturn(false);
        $stream->method('isSeekable')->willReturn(true);
        $stream->expects($this->never())->method('tell');
        $stream->expects($this->never())->method('getContents');

        $this->assertSame('', new GetHttpBodyForLoggingAction()->execute($stream, 'application/json'));
    }

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

    public function testReadsCompleteUtf8BodyAndRestoresCursor(): void
    {
        $body = str_repeat("\u{1F600}", 20_000);
        $stream = Utils::streamFor($body);
        $stream->seek(12);

        $this->assertSame($body, new GetHttpBodyForLoggingAction()->execute($stream, 'text/plain; charset=utf-8'));
        $this->assertSame(12, $stream->tell());
    }

    public function testRestoresCursorWhenReadingFails(): void
    {
        $stream = $this->createMock(StreamInterface::class);
        $stream->method('isReadable')->willReturn(true);
        $stream->method('isSeekable')->willReturn(true);
        $stream->method('tell')->willReturn(7);
        $stream->expects($this->once())->method('rewind');
        $stream->method('getContents')->willThrowException(new \RuntimeException('Read failed'));
        $stream->expects($this->once())->method('seek')->with(7);

        $this->expectException(\RuntimeException::class);

        new GetHttpBodyForLoggingAction()->execute($stream, 'text/plain');
    }
}
