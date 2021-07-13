<?php namespace App\Console\Commands;

use App\Domain\MetricsAggregator;
use App\Domain\MetricsParser;
use App\Domain\ViewsAggregator;
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

    private MetricsParser $metricsParser;
    private ViewsAggregator $viewsAggregator;
    private MetricsAggregator $metricsAggregator;

    public function __destruct()
    {
        $this->stop();
    }

    public function handle(MetricsAggregator $metricsAggregator, MetricsParser $metricsParser, ViewsAggregator $viewsAggregator)
    {
        $this->metricsParser = $metricsParser;
        $this->viewsAggregator = $viewsAggregator;
        $this->metricsAggregator = $metricsAggregator;

        $this->server = new Server($this->argument('host'), $this->argument('port'), SWOOLE_BASE, SWOOLE_SOCK_UDP);
        $this->listeners();
        $this->server->start();
    }

    public function cron()
    {
        $this->metricsAggregator->export();
        $this->viewsAggregator->export();
    }

    public function listeners()
    {
        $this->server->on('packet', function (Server $server, $input) {
            $this->acceptedConnections++;

            $this->metricsParser->parsePayload(
                json_decode($input, true),
                $this->metricsAggregator,
                $this->viewsAggregator
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

        Timer::tick(60000, [$this, 'cron']);
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
