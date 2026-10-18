<?php

return [
    'enabled' => env('PROFILING_ENABLED', false),
    'sample_rate' => (float) env('PROFILING_SAMPLE_RATE', 0.01),
    'frequency' => (int) env('PROFILING_FREQUENCY', 100),
    'endpoint' => env('PROFILING_ENDPOINT', 'http://127.0.0.1:9999'),
    'application' => env('PROFILING_APPLICATION', 'hosting'),

    // Bounds the collected log; 6000 samples cover roughly one minute at 100 Hz.
    'max_samples' => 6000,
    'ignore_paths' => ['health-up'],
];
