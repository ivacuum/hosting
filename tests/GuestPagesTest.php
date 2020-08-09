<?php namespace Tests;

class GuestPagesTest extends TestCase
{
    /**
     * @dataProvider guestPages200
     * @param string $url
     */
    public function testGuestPages200($url)
    {
        $this->get($url)->assertStatus(200);
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
