<?php

namespace App\Console\Commands;

use App\Events\Stats\GalleryImageViewed;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Swoole\Process;

#[Signature('app:image-viewer-server {host=127.0.0.1} {port=2730}')]
#[Description('Image viewer daemon')]
class ImageViewerServer extends Command
{
    private int $acceptedConnections = 0;
    private bool $started = false;
    private Server $server;

    public function __destruct()
    {
        $this->stop();
    }

    public function handle()
    {
        \Validator::make($this->arguments(), [
            'host' => 'required|string|ip',
            'port' => 'required|integer|min:1|max:65535',
        ])->validate();

        $this->server = new Server(
            $this->argument('host'),
            $this->argument('port'),
            SWOOLE_BASE,
            SWOOLE_SOCK_TCP
        );

        $this->listeners();
        $this->server->start();
    }

    public function handleRequest(Request $request, Response $response): void
    {
        $this->acceptedConnections++;

        if (app()->isLocal()) {
            logs()->debug('image_viewer.request_received', [
                'uri' => $request->server['request_uri'],
            ]);
        }

        // $referrer = $request->header['referer'] ?? null;

        if (preg_match('/^\/g\/(?<date>\d{6})\/(?<subfolder>[st]\/)?(?<slug>\d+_[\da-zA-Z]{10}\.[a-z]{3,4})$/', $request->server['request_uri'], $matches)) {
            $date = implode('/', str_split($matches['date'], 2));

            $response->status(302);
            $response->header('X-Accel-Redirect', "/d/g/{$date}/{$matches['subfolder']}{$matches['slug']}");
            $response->end();

            if (in_array($matches['subfolder'], ['', 's/'])) {
                try {
                    event(new GalleryImageViewed("{$matches['date']}/{$matches['slug']}"));
                } catch (\Throwable $e) {
                    report($e);
                }
            }

            return;
        }

        $response->status(404);
        $response->end('Not Found');
    }

    public function listeners()
    {
        $this->server->on('request', $this->handleRequest(...));

        $this->server->on('start', function (Server $server) {
            $this->started = true;
            logs()->info('image_viewer.started', [
                'host' => $server->host,
                'port' => $server->port,
                'pid' => getmypid(),
            ]);

            // Ctrl+C
            Process::signal(SIGINT, function () {
                logs()->info('image_viewer.signal_received', [
                    'signal' => 'SIGINT',
                    'pid' => getmypid(),
                ]);
                $this->stop();
            });
        });

        $this->server->on('shutdown', function () {
            logs()->info('image_viewer.stopped', [
                'accepted_connections' => $this->acceptedConnections,
                'pid' => getmypid(),
            ]);
        });

        $this->server->on('workerstop', function () {
            logs()->info('image_viewer.worker_stopped', [
                'pid' => getmypid(),
            ]);
        });
    }

    public function stop()
    {
        if ($this->started) {
            $this->server->shutdown();
            $this->server->stop();
            $this->started = false;
        }
    }
}
