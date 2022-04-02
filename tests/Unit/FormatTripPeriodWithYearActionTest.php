<?php namespace Tests\Unit;

use App\Action\FormatTripPeriodWithYearAction;
use App\Domain\Locale;
use Carbon\Carbon;
use Tests\TestCase;

class FormatTripPeriodWithYearActionTest extends TestCase
{
    /** @dataProvider english */
    public function testEnglish(string $start, string $end, string $result)
    {
        $this->app->setLocale(Locale::Eng->value);

        $format = new FormatTripPeriodWithYearAction;

        $this->assertSame($result, $format->execute(Carbon::parse($start), Carbon::parse($end)));
    }

    /** @dataProvider russian */
    public function testRussian(string $start, string $end, string $result)
    {
        $this->app->setLocale(Locale::Rus->value);

        $format = new FormatTripPeriodWithYearAction;

        $this->assertSame($result, $format->execute(Carbon::parse($start), Carbon::parse($end)));
    }

    public function english()
    {
        yield 'same day' => ['2022-01-01', '2022-01-01', 'January&nbsp;1,&nbsp;2022'];
        yield 'same month' => ['2022-01-01', '2022-01-09', 'January&nbsp;1–9,&nbsp;2022'];
        yield 'different months' => ['2022-01-01', '2022-02-01', 'January&nbsp;1 – February&nbsp;1,&nbsp;2022'];
    }

    public function russian()
    {
        yield 'same day' => ['2022-01-01', '2022-01-01', '1&nbsp;января&nbsp;2022'];
        yield 'same month' => ['2022-01-01', '2022-01-09', '1–9&nbsp;января&nbsp;2022'];
        yield 'different months' => ['2022-01-01', '2022-02-01', '1&nbsp;января – 1&nbsp;февраля&nbsp;2022'];
    }
}
