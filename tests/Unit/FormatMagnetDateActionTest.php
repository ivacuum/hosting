<?php

namespace Tests\Unit;

use App\Domain\Locale;
use App\Domain\Magnet\Action\FormatMagnetDateAction;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class FormatMagnetDateActionTest extends TestCase
{
    #[TestWith(['2022-01-01', '2022-01-01', 'Today, January&nbsp;1'], 'same day')]
    #[TestWith(['2022-01-02', '2022-01-01', 'Yesterday, January&nbsp;1'], 'last day')]
    #[TestWith(['2022-01-05', '2022-01-01', 'January&nbsp;1'], 'last week')]
    #[TestWith(['2022-02-01', '2022-01-01', 'January&nbsp;1'], 'last month')]
    #[TestWith(['2022-01-01', '2021-12-31', 'December&nbsp;31, 2021'], 'last year')]
    #[TestWith(['2022-01-01', '2011-06-01', 'June&nbsp;1, 2011'], 'long ago')]
    public function testEnglish(string $now, string $commentCreatedAt, string $result)
    {
        $this->app->setLocale(Locale::Eng->value);

        $this->travelTo($now);

        $format = new FormatMagnetDateAction;

        $this->assertSame($result, $format->execute(Carbon::parse($commentCreatedAt)));
    }

    #[TestWith(['2022-01-01', '2022-01-01', 'Сегодня, 1&nbsp;января'], 'same day')]
    #[TestWith(['2022-01-02', '2022-01-01', 'Вчера, 1&nbsp;января'], 'last day')]
    #[TestWith(['2022-01-05', '2022-01-01', '1&nbsp;января'], 'last week')]
    #[TestWith(['2022-02-01', '2022-01-01', '1&nbsp;января'], 'last month')]
    #[TestWith(['2022-01-01', '2021-12-31', '31&nbsp;декабря&nbsp;2021'], 'last year')]
    #[TestWith(['2022-01-01', '2011-06-01', '1&nbsp;июня&nbsp;2011'], 'long ago')]
    public function testRussian(string $now, string $commentCreatedAt, string $result)
    {
        $this->app->setLocale(Locale::Rus->value);

        $this->travelTo($now);

        $format = new FormatMagnetDateAction;

        $this->assertSame($result, $format->execute(Carbon::parse($commentCreatedAt)));
    }
}
