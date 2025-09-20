<?php

namespace Tests\Unit;

use App\Domain\Life\Action\FormatTripPeriodAction;
use App\Domain\Locale;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class FormatTripPeriodActionTest extends TestCase
{
    #[TestWith(['2022-01-01', '2022-01-01', 'January&nbsp;1'], 'same day')]
    #[TestWith(['2022-01-01', '2022-01-09', 'January&nbsp;1–9'], 'same month')]
    #[TestWith(['2022-01-01', '2022-02-01', 'January&nbsp;1 – February&nbsp;1'], 'different months')]
    public function testEnglish(string $start, string $end, string $result)
    {
        $this->app->setLocale(Locale::Eng->value);

        $format = new FormatTripPeriodAction;

        $this->assertSame($result, $format->execute(Carbon::parse($start), Carbon::parse($end)));
    }

    #[TestWith(['2022-01-01', '2022-01-01', '1&nbsp;января'], 'same day')]
    #[TestWith(['2022-01-01', '2022-01-09', '1–9&nbsp;января'], 'same month')]
    #[TestWith(['2022-01-01', '2022-02-01', '1&nbsp;января – 1&nbsp;февраля'], 'different months')]
    public function testRussian(string $start, string $end, string $result)
    {
        $this->app->setLocale(Locale::Rus->value);

        $format = new FormatTripPeriodAction;

        $this->assertSame($result, $format->execute(Carbon::parse($start), Carbon::parse($end)));
    }
}
