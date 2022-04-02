<?php namespace Tests\Unit;

use App\Action\FormatMagnetDateAction;
use App\Domain\Locale;
use Carbon\Carbon;
use Tests\TestCase;

class FormatMagnetDateActionTest extends TestCase
{
    /** @dataProvider english */
    public function testEnglish(string $now, string $commentCreatedAt, string $result)
    {
        $this->app->setLocale(Locale::Eng->value);

        $this->travelTo($now);

        $format = new FormatMagnetDateAction;

        $this->assertSame($result, $format->execute(Carbon::parse($commentCreatedAt)));
    }

    /** @dataProvider russian */
    public function testRussian(string $now, string $commentCreatedAt, string $result)
    {
        $this->app->setLocale(Locale::Rus->value);

        $this->travelTo($now);

        $format = new FormatMagnetDateAction;

        $this->assertSame($result, $format->execute(Carbon::parse($commentCreatedAt)));
    }

    public function english()
    {
        yield 'same day' => ['2022-01-01', '2022-01-01', 'Today, January&nbsp;1'];
        yield 'last day' => ['2022-01-02', '2022-01-01', 'Yesterday, January&nbsp;1'];
        yield 'last week' => ['2022-01-05', '2022-01-01', 'January&nbsp;1'];
        yield 'last month' => ['2022-02-01', '2022-01-01', 'January&nbsp;1'];
        yield 'last year' => ['2022-01-01', '2021-12-31', 'December&nbsp;31, 2021'];
        yield 'long ago' => ['2022-01-01', '2011-06-01', 'June&nbsp;1, 2011'];
    }

    public function russian()
    {
        yield 'same day' => ['2022-01-01', '2022-01-01', 'Сегодня, 1&nbsp;января'];
        yield 'last day' => ['2022-01-02', '2022-01-01', 'Вчера, 1&nbsp;января'];
        yield 'last week' => ['2022-01-05', '2022-01-01', '1&nbsp;января'];
        yield 'last month' => ['2022-02-01', '2022-01-01', '1&nbsp;января'];
        yield 'last year' => ['2022-01-01', '2021-12-31', '31&nbsp;декабря&nbsp;2021'];
        yield 'long ago' => ['2022-01-01', '2011-06-01', '1&nbsp;июня&nbsp;2011'];
    }
}
