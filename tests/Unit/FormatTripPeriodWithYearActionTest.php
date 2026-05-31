<?php

namespace Tests\Unit;

use App\Domain\Life\Action\FormatTripPeriodWithYearAction;
use App\Domain\Locale;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class FormatTripPeriodWithYearActionTest extends TestCase
{
    #[TestWith(['2022-01-01', '2022-01-01', "January\u{00A0}1,\u{00A0}2022"], 'same day')]
    #[TestWith(['2022-01-01', '2022-01-09', "January\u{00A0}1–9,\u{00A0}2022"], 'same month')]
    #[TestWith(['2022-01-01', '2022-02-01', "January\u{00A0}1 – February\u{00A0}1,\u{00A0}2022"], 'different months')]
    public function testEnglish(string $start, string $end, string $result)
    {
        $this->app->setLocale(Locale::Eng->value);

        $format = new FormatTripPeriodWithYearAction;

        $this->assertSame($result, $format->execute(Carbon::parse($start), Carbon::parse($end)));
    }

    #[TestWith(['2022-01-01', '2022-01-01', "1\u{00A0}января\u{00A0}2022"], 'same day')]
    #[TestWith(['2022-01-01', '2022-01-09', "1–9\u{00A0}января\u{00A0}2022"], 'same month')]
    #[TestWith(['2022-01-01', '2022-02-01', "1\u{00A0}января – 1\u{00A0}февраля\u{00A0}2022"], 'different months')]
    public function testRussian(string $start, string $end, string $result)
    {
        $this->app->setLocale(Locale::Rus->value);

        $format = new FormatTripPeriodWithYearAction;

        $this->assertSame($result, $format->execute(Carbon::parse($start), Carbon::parse($end)));
    }
}
