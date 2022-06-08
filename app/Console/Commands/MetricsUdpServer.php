<?php namespace App\Console\Commands;

use App\Action\HandleMetricPayloadAction;
use App\Action\PingDatabaseAction;
use App\Domain\ImageViewsAggregator;
use App\Domain\MetricsAggregator;
use App\Domain\PhotoViewsAggregator;
use App\Domain\ViewsAggregator;
use Carbon\CarbonInterval;
use Ivacuum\Generic\Commands\Command;
use Swoole\Process;
use Swoole\Server;
use Swoole\Timer;

class MetricsUdpServer extends Command
{
    protected $signature = 'app:metrics-udp-server {host=127.0.0.1} {port=2720}';
    protected $description = 'Metrics daemon';

    private int $acceptedConnections = 0;
    private bool $started = false;
    private Server $server;

    private ViewsAggregator $viewsAggregator;
    private MetricsAggregator $metricsAggregator;
    private PingDatabaseAction $pingDatabase;
    private ImageViewsAggregator $imageViewsAggregator;
    private PhotoViewsAggregator $photoViewsAggregator;
    private HandleMetricPayloadAction $handleMetricPayload;

    public function __destruct()
    {
        $this->stop();
    }

    public function handle(
        MetricsAggregator $metricsAggregator,
        HandleMetricPayloadAction $handleMetricPayload,
        ViewsAggregator $viewsAggregator,
        ImageViewsAggregator $imageViewsAggregator,
        PhotoViewsAggregator $photoViewsAggregator,
        PingDatabaseAction $pingDatabase
    ) {
        $this->pingDatabase = $pingDatabase;
        $this->viewsAggregator = $viewsAggregator;
        $this->metricsAggregator = $metricsAggregator;
        $this->handleMetricPayload = $handleMetricPayload;
        $this->imageViewsAggregator = $imageViewsAggregator;
        $this->photoViewsAggregator = $photoViewsAggregator;

        $this->server = new Server(
            $this->argument('host'),
            $this->argument('port'),
            SWOOLE_BASE,
            SWOOLE_SOCK_UDP
        );

        $this->listeners();
        $this->server->start();
    }

    public function cron()
    {
        $this->pingDatabase->execute();

        $this->metricsAggregator->export();
        $this->viewsAggregator->export();
        $this->imageViewsAggregator->export();
        $this->photoViewsAggregator->export();
    }

    public function listeners()
    {
        $this->server->on('packet', function (Server $server, $input) {
            $this->acceptedConnections++;

            if (app()->isLocal()) {
                $this->info($input);
            }

            $this->handleMetricPayload->execute(
                json_decode($input, true),
                $this->metricsAggregator,
                $this->viewsAggregator,
                $this->imageViewsAggregator,
                $this->photoViewsAggregator
            );
        });

        $this->server->on('start', function (Server $server) {
            $this->started = true;
            $this->info("Принимаем входящие пакеты по адресу UDP {$server->host}:{$server->port}");

            // Ctrl+C
            Process::signal(SIGINT, function () {
                $this->info('Получен сигнал SIGINT');
                $this->stop();
            });
        });

        $this->server->on('shutdown', function () {
            $this->info("Сервис остановлен. Подключений принято: {$this->acceptedConnections}");
            $this->cron();
        });

        $this->server->on('workerstop', function () {
            $this->info('WorkerStop');
        });

        Timer::tick($this->cronInterval()->totalMilliseconds, $this->cron(...));
    }

    public function stop()
    {
        if ($this->started) {
            $this->server->shutdown();
            $this->server->stop();
            $this->started = false;
        }
    }

    private function cronInterval(): CarbonInterval
    {
        return app()->isLocal()
            ? CarbonInterval::seconds(10)
            : CarbonInterval::minute();
    }
}
