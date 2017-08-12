<?php namespace Tests;

class SiteTest extends TestCase
{
    public function testPages()
    {
        $this->get('/')->assertStatus(200);
        $this->get('/about')->assertStatus(200);
        $this->get('/auth/login')->assertStatus(200);
        $this->get('/auth/register')->assertStatus(200);
        $this->get('/auth/password/remind')->assertStatus(200);
        $this->get('/dc')->assertStatus(200);
        $this->get('/dc/faq')->assertStatus(200);
        $this->get('/docs')->assertStatus(200);
        $this->get('/files')->assertStatus(200);
        $this->get('/life')->assertStatus(200);
        $this->get('/life/cities')->assertStatus(200);
        $this->get('/life/kaluga')->assertStatus(200);
        $this->get('/life/countries')->assertStatus(200);
        $this->get('/life/countries/russia')->assertStatus(200);
        $this->get('/life/gigs')->assertStatus(200);
        $this->get('/life/japanese')->assertStatus(200);
        $this->get('/news')->assertStatus(200);
        $this->get('/news/1')->assertStatus(200);
        $this->get('/photos')->assertStatus(200);
        $this->get('/photos/cities')->assertStatus(200);
        $this->get('/photos/cities/barcelona')->assertStatus(200);
        $this->get('/photos/countries')->assertStatus(200);
        $this->get('/photos/countries/russia')->assertStatus(200);
        $this->get('/photos/map')->assertStatus(200);
        $this->get('/photos/tags')->assertStatus(200);
        $this->get('/photos/tags/1')->assertStatus(200);
        $this->get('/photos/trips')->assertStatus(200);
        $this->get('/photos/trips/1')->assertStatus(200);
        $this->get('/promocodes-coupons')->assertStatus(200);
        $this->get('/promocodes-coupons/airbnb')->assertStatus(200);
        $this->get('/promocodes-coupons/digitalocean')->assertStatus(200);
        $this->get('/promocodes-coupons/firstvds')->assertStatus(200);
        $this->get('/retracker')->assertStatus(200);
        $this->get('/retracker/dev')->assertStatus(200);
        $this->get('/retracker/usage')->assertStatus(200);
        $this->get('/torrent')->assertStatus(200);
        $this->get('/torrents')->assertStatus(200);
        $this->get('/torrents/comments')->assertStatus(200);
        $this->get('/torrents/faq')->assertStatus(200);
        $this->get('/users')->assertStatus(200);
        $this->get('/users/1')->assertStatus(200);
    }

    public function testUserPages()
    {
        $this->be(\App\User::find(1));

        $this->get('/gallery')->assertStatus(200);
        $this->get('/gallery/upload')->assertStatus(200);
        $this->get('/my')->assertStatus(200);
        $this->get('/my/password')->assertStatus(200);
        $this->get('/my/profile')->assertStatus(200);
        $this->get('/my/settings')->assertStatus(200);
        $this->get('/notifications')->assertStatus(200);
        $this->get('/torrents/add')->assertStatus(200);
        $this->get('/torrents/my')->assertStatus(200);
    }

    public function testTripsTemplates()
    {
        $this->be(\App\User::find(1));

        foreach (\App\Trip::templatesIterator() as $template) {
            $this->get("/acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertStatus(200);
        }
    }

    public function testAcpPages()
    {
        $this->be(\App\User::find(1));

        $this->get('/acp/artists')->assertStatus(200);
        $this->get('/acp/artists/create')->assertStatus(200);

        $this->get('/acp/cities')->assertStatus(200);
        $this->get('/acp/cities/create')->assertStatus(200);

        $this->get('/acp/clients')->assertStatus(200);
        $this->get('/acp/clients/create')->assertStatus(200);

        $this->get('/acp/comments')->assertStatus(200);

        $this->get('/acp/countries')->assertStatus(200);
        $this->get('/acp/countries/create')->assertStatus(200);

        $this->get('/acp/domains')->assertStatus(200);
        $this->get('/acp/domains/create')->assertStatus(200);

        $this->get('/acp/files')->assertStatus(200);
        $this->get('/acp/files/create')->assertStatus(200);

        $this->get('/acp/gigs')->assertStatus(200);
        $this->get('/acp/gigs/create')->assertStatus(200);

        $this->get('/acp/images')->assertStatus(200);

        $this->get('/acp/metrics')->assertStatus(200);

        $this->get('/acp/news')->assertStatus(200);
        $this->get('/acp/news/create')->assertStatus(200);

        $this->get('/acp/photos')->assertStatus(200);
        $this->get('/acp/photos/create')->assertStatus(200);

        $this->get('/acp/servers')->assertStatus(200);
        $this->get('/acp/servers/create')->assertStatus(200);

        $this->get('/acp/tags')->assertStatus(200);
        $this->get('/acp/tags/create')->assertStatus(200);

        $this->get('/acp/torrents')->assertStatus(200);

        $this->get('/acp/trips')->assertStatus(200);
        $this->get('/acp/trips/create')->assertStatus(200);

        $this->get('/acp/users')->assertStatus(200);

        $this->get('/acp/yandex-users')->assertStatus(200);
        $this->get('/acp/yandex-users/create')->assertStatus(200);
    }
}
