<?php namespace App\Console\Commands;

use App\Events\Stats\GalleryImageViewed;
use Ivacuum\Generic\Commands\Command;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;
use Swoole\Process;

class ImageViewerServer extends Command
{
    protected $signature = 'app:image-viewer-server {host=127.0.0.1} {port=2730}';
    protected $description = 'Image viewer daemon';

    private int $acceptedConnections = 0;
    private bool $started = false;
    private Server $server;

    public function __destruct()
    {
        $this->stop();
    }

    public function handle()
    {
        $this->server = new Server(
            $this->argument('host'),
            $this->argument('port'),
            SWOOLE_BASE,
            SWOOLE_SOCK_TCP
        );

        $this->listeners();
        $this->server->start();
    }

    public function handleRequest(Request $request, Response $response)
    {
        $this->acceptedConnections++;

        if (app()->isLocal()) {
            $this->info($request->server['request_uri']);
        }

        // $referrer = $request->header['referer'] ?? null;

        if (preg_match('/^\/g\/(?<date>\d{6})\/(?<subfolder>[st]\/)?(?<slug>\d+_[\da-zA-Z]{10}\.[a-z]{3,4})$/', $request->server['request_uri'], $matches)) {
            $date = implode('/', str_split($matches['date'], 2));

            event(new GalleryImageViewed("{$matches['date']}/{$matches['slug']}"));

            $response->detach();

            $this->server->send($response->fd, "HTTP/1.1 302 Found\r\nContent-Length: 0\r\nX-Accel-Redirect: /d/g/{$date}/{$matches['subfolder']}{$matches['slug']}\r\n\r\n");

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
            $this->info("Принимаем входящие пакеты по адресу TCP {$server->host}:{$server->port}");

            // Ctrl+C
            Process::signal(SIGINT, function () {
                $this->info('Получен сигнал SIGINT');
                $this->stop();
            });
        });

        $this->server->on('shutdown', function () {
            $this->info("Сервис остановлен. Подключений принято: {$this->acceptedConnections}");
        });

        $this->server->on('workerstop', function () {
            $this->info('WorkerStop');
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
