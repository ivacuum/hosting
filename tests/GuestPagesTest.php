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
            ['/docs/trips'],
            ['/japanese'],
            ['/japanese/hiragana-katakana'],
            ['/japanese/wanikani'],
            ['/japanese/wanikani/level/1'],
            ['/promocodes-coupons'],
            ['/promocodes-coupons/airbnb'],
            ['/promocodes-coupons/booking'],
            ['/promocodes-coupons/digitalocean'],
            ['/promocodes-coupons/firstvds'],
            ['/promocodes-coupons/timeweb'],
            ['/retracker'],
            ['/retracker/dev'],
            ['/retracker/usage'],
            ['/stickers'],
            ['/subscriptions'],
            ['/torrent'],
            ['/torrents'],
            ['/torrents?category_id=2'],
            ['/torrents/comments'],
            ['/torrents/faq'],
            ['/torrents?q=2017'],
        ];
    }
}
