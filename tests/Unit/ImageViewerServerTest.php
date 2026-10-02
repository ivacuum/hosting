<?php

namespace Tests\Unit;

use App\Console\Commands\ImageViewerServer;
use App\Domain\Metrics\Action\ExportMetricsAction;
use App\Domain\Metrics\Listener\WildcardMetricsListener;
use App\Events\Stats\GalleryImageViewed;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Exceptions;
use PHPUnit\Framework\Attributes\TestWith;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Tests\TestCase;

class ImageViewerServerTest extends TestCase
{
    #[TestWith(['', true], 'original')]
    #[TestWith(['s/', true], 'small')]
    #[TestWith(['t/', false], 'thumbnail')]
    public function testImageRedirect(string $subfolder, bool $tracked): void
    {
        Event::fake([GalleryImageViewed::class]);
        $response = \Mockery::mock(Response::class);
        $response->expects('status')->with(302)->andReturn(true);
        $response
            ->expects('header')
            ->with('X-Accel-Redirect', "/d/g/26/10/02/{$subfolder}1_abcdefghij.jpg")
            ->andReturn(true);
        $response->expects('end')->withNoArgs()->andReturn(true);

        app(ImageViewerServer::class)
            ->handleRequest($this->request("/g/261002/{$subfolder}1_abcdefghij.jpg"), $response);

        if ($tracked) {
            Event::assertDispatched(GalleryImageViewed::class, static fn (GalleryImageViewed $event): bool => $event->dateAndSlug === '261002/1_abcdefghij.jpg');
        } else {
            Event::assertNotDispatched(GalleryImageViewed::class);
        }
    }

    public function testMetricsFailureIsReportedAfterRespondingAndDoesNotAccumulate(): void
    {
        Exceptions::fake();
        Event::listen(['App\Events\Stats\*'], WildcardMetricsListener::class);
        $exception = new \RuntimeException('Redis unavailable');
        $responded = false;
        $response = \Mockery::mock(Response::class);
        $response->expects('status')->twice()->with(302)->andReturn(true);
        $response->expects('header')
            ->with('X-Accel-Redirect', '/d/g/26/10/02/1_abcdefghij.jpg')
            ->andReturn(true);
        $response->expects('header')
            ->with('X-Accel-Redirect', '/d/g/26/10/03/2_klmnopqrst.jpg')
            ->andReturn(true);
        $response->expects('end')->twice()->withNoArgs()->andReturnUsing(static function () use (&$responded): bool {
            $responded = true;

            return true;
        });

        $exports = [];
        $this->mock(ExportMetricsAction::class)
            ->expects('execute')
            ->twice()
            ->andReturnUsing(static function (array $metrics) use (&$exports, &$responded, $exception): void {
                $exports[] = ['responded' => $responded, 'metrics' => $metrics];

                if (count($exports) === 1) {
                    throw $exception;
                }
            });

        $server = app(ImageViewerServer::class);
        $server->handleRequest($this->request('/g/261002/1_abcdefghij.jpg'), $response);
        $responded = false;
        $server->handleRequest($this->request('/g/261003/2_klmnopqrst.jpg'), $response);

        $this->assertEquals([
            [
                'responded' => true,
                'metrics' => [['event' => 'GalleryImageViewed', 'data' => new GalleryImageViewed('261002/1_abcdefghij.jpg')]],
            ],
            [
                'responded' => true,
                'metrics' => [['event' => 'GalleryImageViewed', 'data' => new GalleryImageViewed('261003/2_klmnopqrst.jpg')]],
            ],
        ], $exports);
        Exceptions::assertReported(static fn (\RuntimeException $reported): bool => $reported === $exception);
        Exceptions::assertReportedCount(1);
    }

    private function request(string $uri): Request
    {
        $request = new Request;
        $request->server = ['request_uri' => $uri];

        return $request;
    }
}
