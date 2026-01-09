<?php

namespace App\Utilities;

class UserAgent
{
    /**
     * Чистка строки названия браузера от неактуальных подстрок
     */
    public static function tidy(string $ua): string
    {
        $ua = str_replace(
            [
                '(KHTML, like Gecko) ',
                'Mozilla/4.0 ',
                'Mozilla/5.0 ',
                ' like Gecko',
                ' Safari/537.36',
                ' Yowser/2.5',
                ' (Edition Yx)',
                '; Trident/4.0',
                '; Trident/5.0',
                '; Trident/6.0',
                '; WOW64',
                '; .NET4.0E',
                '; .NET4.0C',
                '; .NET CLR 3.5.30729',
                '; .NET CLR 3.0.30729',
                '; .NET CLR 2.0.50727',
                'compatible; ',
            ],
            '',
            $ua
        );

        $ua = str_replace(
            [
                'Windows NT 5.1',
                // 'Windows NT 5.2',
                'Windows NT 6.0',
                'Windows NT 6.1',
                'Windows NT 6.2',
                'Windows NT 6.3',
                'Windows NT 10.0',
                'MSIE 6.0',
                'MSIE 7.0',
                'MSIE 8.0',
                'MSIE 9.0',
                'MSIE 10.0',
                'Trident/7.0',
                '; Win64, x64',
                '; Win64; x64',
            ],
            [
                'Windows XP',
                // 'Windows Server 2003 or Windows XP x64',
                'Windows Vista',
                'Windows 7',
                'Windows 8',
                'Windows 8.1',
                'Windows 10',
                'IE6',
                'IE7',
                'IE8',
                'IE9',
                'IE10',
                'IE11',
                ' x64',
                ' x64',
            ],
            $ua
        );

        $ua = preg_replace('/(; rv:([\d\.]+))\)/', ')', $ua);

        return preg_replace('/(AppleWebKit|Gecko)\/([\d\.]+) /', '', $ua);
    }
}
