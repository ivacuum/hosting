<?php

use Carbon\CarbonInterface;
use Symfony\Component\VarDumper\Cloner\AbstractCloner;

$app = new Illuminate\Foundation\Application(
    $_ENV['APP_BASE_PATH'] ?? dirname(__DIR__)
);

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

AbstractCloner::$defaultCasters[CarbonInterface::class] = App\Caster\CarbonCaster::prune(...);

return $app;
