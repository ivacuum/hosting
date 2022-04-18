<?php namespace App\Domain;

class MetricsParser
{
    public function parsePayload(array $json, MetricsAggregator $metricsAggregator, ViewsAggregator $viewsAggregator): void
    {
        foreach ($json as $payload) {
            if (empty($payload['event'])) {
                continue;
            }

            $event = $payload['event'];

            $metricsAggregator->push($event);

            if (str_ends_with($event, 'Viewed') && !empty($payload['data'])) {
                $id = intval($payload['data']['id'] ?? 0);
                $table = $payload['data']['table'] ?? null;

                if ($id > 0 && preg_match('/^[a-z_]+$/', $table)) {
                    $viewsAggregator->push($table, $id);
                }
            }
        }
    }
}
