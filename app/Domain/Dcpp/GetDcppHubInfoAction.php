<?php

namespace App\Domain\Dcpp;

class GetDcppHubInfoAction
{
    public function execute(string $host, int $port = 411): DcppHubInfo
    {
        try {
            $client = new DcppClient($host, $port);
        } catch (DcppHubIsOfflineException $e) {
            report($e);

            return new DcppHubInfo(isOnline: false);
        }

        $isOnline = false;

        if (str_starts_with($client->read(), '$Lock')) {
            $isOnline = true;
        }

        $client->askForHubInfo();
        $response = $client->read();

        $title = null;

        foreach (explode('|', $response) as $line) {
            if (str_starts_with($line, '$HubName')) {
                $title = str($line)
                    ->after('$HubName ')
                    ->toString();
            }
        }

        return new DcppHubInfo($isOnline, $title);
    }
}
