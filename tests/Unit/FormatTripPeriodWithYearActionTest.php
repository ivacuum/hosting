<?php

namespace Tests\Unit;

use App\Domain\Life\Action\FormatTripPeriodWithYearAction;
use App\Domain\Locale;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class FormatTripPeriodWithYearActionTest extends TestCase
{
    #[TestWith(['2022-01-01', '2022-01-01', 'January&nbsp;1,&nbsp;2022'], 'same day')]
    #[TestWith(['2022-01-01', '2022-01-09', 'January&nbsp;1–9,&nbsp;2022'], 'same month')]
    #[TestWith(['2022-01-01', '2022-02-01', 'January&nbsp;1 – February&nbsp;1,&nbsp;2022'], 'different months')]
    public function testEnglish(string $start, string $end, string $result)
    {
        $this->app->setLocale(Locale::Eng->value);

        $format = new FormatTripPeriodWithYearAction;

        $this->assertSame($result, $format->execute(Carbon::parse($start), Carbon::parse($end)));
    }

    #[TestWith(['2022-01-01', '2022-01-01', '1&nbsp;января&nbsp;2022'], 'same day')]
    #[TestWith(['2022-01-01', '2022-01-09', '1–9&nbsp;января&nbsp;2022'], 'same month')]
    #[TestWith(['2022-01-01', '2022-02-01', '1&nbsp;января – 1&nbsp;февраля&nbsp;2022'], 'different months')]
    public function testRussian(string $start, string $end, string $result)
    {
        $this->app->setLocale(Locale::Rus->value);

        $format = new FormatTripPeriodWithYearAction;

        $this->assertSame($result, $format->execute(Carbon::parse($start), Carbon::parse($end)));
    }
}
