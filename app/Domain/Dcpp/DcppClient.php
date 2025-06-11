<?php

namespace App\Domain\Dcpp;

class DcppClient
{
    public function __construct(private string $host, private int $port = 411, int $timeout = 3)
    {
        \Context::add([
            'host' => $host,
            'port' => $port,
        ]);

        try {
            $this->socket = fsockopen($this->host, $this->port, $errorCode, $errorMessage, $timeout);

            stream_set_timeout($this->socket, $timeout);
        } catch (\Throwable $e) {
            throw new DcppHubIsOfflineException(previous: $e);
        }
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    public function askForHubInfo(): void
    {
        $this->send('$Supports BotINFO NoGetINFO NoHello|$BotINFO PingerPinger|');
    }

    public function disconnect(): void
    {
        if (is_resource($this->socket)) {
            fclose($this->socket);
        }
    }

    public function read(): string
    {
        $response = fread($this->socket, 4096);

        if (mb_check_encoding($response, 'windows-1251') === true) {
            $response = iconv('windows-1251', 'utf-8', $response);
        }

        logs()->debug("Response: {$response}");

        return $response;
    }

    public function send(string $request): void
    {
        logs()->debug("Request: {$request}");

        fwrite($this->socket, $request);
    }
}
