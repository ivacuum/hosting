<?php

use App\Console\Commands;
use App\Domain\Config;
use Illuminate\Support\Facades\Schedule;

$cronOutput = Config::CronOutput->get();

// cron('* * * * *')
// 1. minute 0-59
// 2. hour 0-23
// 3. day of month 1-31
// 4. month 1-12
// 5. day of week 0-7 (0 and 7 is Sunday)
Schedule::command(Commands\ProcessMetrics::class)
    ->appendOutputTo($cronOutput);

Schedule::command(Commands\SitemapBuild::class)
    ->dailyAt('2:30')
    ->appendOutputTo($cronOutput);

Schedule::command('model:prune', [
    '--model' => [
        App\ExternalHttpRequest::class,
        App\PasswordResetToken::class,
    ],
])
    ->twiceDailyAt(first: 2, second: 14, offset: 35)
    ->appendOutputTo($cronOutput);

Schedule::command(Commands\TrimMetricsStream::class)
    ->cron('38 2,14 * * *')
    ->twiceDailyAt(first: 2, second: 14, offset: 38)
    ->appendOutputTo($cronOutput);

Schedule::command(Commands\RtoUpdate::class)
    ->everyThreeHours(offset: 20)
    ->appendOutputTo($cronOutput);

Schedule::command(Commands\PingDcppHubs::class)
    ->dailyAt('15:25')
    ->appendOutputTo($cronOutput);
