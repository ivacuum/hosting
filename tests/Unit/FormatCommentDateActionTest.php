<?php

namespace Tests\Unit;

use App\Action\FormatCommentDateAction;
use App\Domain\Locale;
use Carbon\Carbon;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class FormatCommentDateActionTest extends TestCase
{
    #[TestWith(['2022-01-01', '2022-01-01', 'Today, January&nbsp;1 at 12:00 AM'], 'same day')]
    #[TestWith(['2022-01-02', '2022-01-01', 'Yesterday, January&nbsp;1 at 12:00 AM'], 'last day')]
    #[TestWith(['2022-01-05', '2022-01-01', 'January&nbsp;1 at 12:00 AM'], 'last week')]
    #[TestWith(['2022-02-01', '2022-01-01', 'January&nbsp;1 at 12:00 AM'], 'last month')]
    #[TestWith(['2022-01-01', '2021-12-31', 'December&nbsp;31, 2021 at 12:00 AM'], 'last year')]
    #[TestWith(['2022-01-01', '2011-06-01', 'June&nbsp;1, 2011 at 12:00 AM'], 'long ago')]
    public function testEnglish(string $now, string $commentCreatedAt, string $result)
    {
        $this->app->setLocale(Locale::Eng->value);

        $this->travelTo($now);

        $format = new FormatCommentDateAction;

        $this->assertSame($result, $format->execute(Carbon::parse($commentCreatedAt)));
    }

    #[TestWith(['2022-01-01', '2022-01-01', 'Сегодня, 1&nbsp;января в 00:00'], 'same day')]
    #[TestWith(['2022-01-02', '2022-01-01', 'Вчера, 1&nbsp;января в 00:00'], 'last day')]
    #[TestWith(['2022-01-05', '2022-01-01', '1&nbsp;января в 00:00'], 'last week')]
    #[TestWith(['2022-02-01', '2022-01-01', '1&nbsp;января в 00:00'], 'last month')]
    #[TestWith(['2022-01-01', '2021-12-31', '31&nbsp;декабря&nbsp;2021 в 00:00'], 'last year')]
    #[TestWith(['2022-01-01', '2011-06-01', '1&nbsp;июня&nbsp;2011 в 00:00'], 'long ago')]
    public function testRussian(string $now, string $commentCreatedAt, string $result)
    {
        $this->app->setLocale(Locale::Rus->value);

        $this->travelTo($now);

        $format = new FormatCommentDateAction;

        $this->assertSame($result, $format->execute(Carbon::parse($commentCreatedAt)));
    }
}
