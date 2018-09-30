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

    public function testPageLifeGigsRss()
    {
        $this->get('/life/gigs/rss')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml');
    }

    public function testPageLifeRss()
    {
        $this->get('/life/rss')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml');
    }

    public function testPageNewsRss()
    {
        $this->get('/news/rss')
            ->assertStatus(200)
            ->assertHeader('Content-Type', 'application/xml');
    }

    public function guestPages200()
    {
        return [
            ['/'],
            ['/about'],
            ['/auth/login'],
            ['/auth/register'],
            ['/auth/password/remind'],
            ['/dc'],
            ['/dc/faq'],
            ['/dc/hubs'],
            ['/docs'],
            ['/docs/trips'],
            ['/japanese'],
            ['/japanese/hiragana-katakana'],
            ['/japanese/wanikani'],
            ['/japanese/wanikani/level/1'],
            ['/life'],
            ['/life/calendar'],
            ['/life/cities'],
            ['/life/kaluga'],
            ['/life/countries'],
            ['/life/countries/russia'],
            ['/life/english'],
            ['/life/gigs'],
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
