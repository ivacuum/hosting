<?php namespace Tests;

class GuestPagesTest extends TestCase
{
    #[\PHPUnit\Framework\Attributes\DataProvider('guestPages200')]
    public function testGuestPages200(string $url)
    {
        $this->get($url)->assertOk();
    }

    public static function guestPages200()
    {
        yield ['/auth/login'];
        yield ['/auth/register'];
        yield ['/auth/password/remind'];
        yield ['/docs'];
        yield ['/docs/amazon-s3'];
        yield ['/docs/freebsd'];
        yield ['/docs/nginx'];
        yield ['/docs/trips'];
        yield ['/retracker'];
        yield ['/retracker/dev'];
        yield ['/retracker/usage'];
        yield ['/stickers'];
        yield ['/subscriptions'];
    }
}
