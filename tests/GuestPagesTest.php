<?php namespace Tests;

class GuestPagesTest extends TestCase
{
    /** @dataProvider guestPages200 */
    public function testGuestPages200(string $url)
    {
        $this->get($url)->assertOk();
    }

    public function guestPages200()
    {
        return [
            ['/auth/login'],
            ['/auth/register'],
            ['/auth/password/remind'],
            ['/docs'],
            ['/docs/amazon-s3'],
            ['/docs/freebsd'],
            ['/docs/nginx'],
            ['/docs/trips'],
            ['/retracker'],
            ['/retracker/dev'],
            ['/retracker/usage'],
            ['/stickers'],
            ['/subscriptions'],
        ];
    }
}
