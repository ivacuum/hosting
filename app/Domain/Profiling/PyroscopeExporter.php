<?php

namespace App\Domain\Profiling;

use Illuminate\Container\Attributes\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PyroscopeExporter
{
    public function __construct(
        #[Config('profiling.application')]
        private readonly string $application,
        #[Config('profiling.endpoint')]
        private readonly string $endpoint,
        #[Config('app.env')]
        private readonly string $environment,
    ) {}

    /**
     * @param  array<string, string>  $labels
     */
    public function send(string $body, float $startedAt, float $stoppedAt, array $labels, int $frequency): void
    {
        try {
            $tags = [];

            foreach (['environment' => $this->environment, ...$labels] as $key => $value) {
                // The legacy ingest label syntax has no quoting or escaping mechanism.
                $tags[] = $key . '=' . strtr($value, ['%' => '%25', ',' => '%2C', '{' => '%7B', '}' => '%7D']);
            }

            $query = http_build_query([
                'name' => $this->application . '.wall{' . implode(',', $tags) . '}',
                'from' => sprintf('%.6F', $startedAt),
                'until' => sprintf('%.6F', $stoppedAt),
                'format' => 'folded',
                'sampleRate' => $frequency,
                'units' => 'samples',
                'aggregationType' => 'sum',
            ]);

            Http::connectTimeout(0.1)
                ->timeout(0.2)
                ->withBody($body, 'text/plain')
                ->post(rtrim($this->endpoint, '/') . '/ingest?' . $query)
                ->throw();
        } catch (\Throwable $exception) {
            Log::debug('Pyroscope profile export failed.', ['error' => $exception->getMessage()]);
        }
    }
}
