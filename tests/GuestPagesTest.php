<?php namespace Tests;

class GuestPagesTest extends TestCase
{
    public function testPageHome()
    {
        $this->get('/')->assertStatus(200);
    }

    public function testPageAbout()
    {
        $this->get('/about')->assertStatus(200);
    }

    public function testPageAuthLogin()
    {
        $this->get('/auth/login')->assertStatus(200);
    }

    public function testPageAuthRegister()
    {
        $this->get('/auth/register')->assertStatus(200);
    }

    public function testPageAuthPasswordRemind()
    {
        $this->get('/auth/password/remind')->assertStatus(200);
    }

    public function testPageDc()
    {
        $this->get('/dc')->assertStatus(200);
    }

    public function testPageDcFaq()
    {
        $this->get('/dc/faq')->assertStatus(200);
    }

    public function testPageDocs()
    {
        $this->get('/docs')->assertStatus(200);
    }

    public function testPageFiles()
    {
        $this->get('/files')->assertStatus(200);
    }

    public function testPageLife()
    {
        $this->get('/life')->assertStatus(200);
    }

    public function testPageLifeCities()
    {
        $this->get('/life/cities')->assertStatus(200);
    }

    public function testPageLifeCity()
    {
        $this->get('/life/kaluga')->assertStatus(200);
    }

    public function testPageLifeCountries()
    {
        $this->get('/life/countries')->assertStatus(200);
    }

    public function testPageLifeCountry()
    {
        $this->get('/life/countries/russia')->assertStatus(200);
    }

    public function testPageLifeGigs()
    {
        $this->get('/life/gigs')->assertStatus(200);
    }

    public function testPageLifePage()
    {
        $this->get('/life/japanese')->assertStatus(200);
    }

    public function testPageNews()
    {
        $this->get('/news')->assertStatus(200);
    }

    public function testPageNewsShow()
    {
        $this->get('/news/1')->assertStatus(200);
    }

    public function testPagePhotos()
    {
        $this->get('/photos')->assertStatus(200);
    }

    public function testPagePhotosCities()
    {
        $this->get('/photos/cities')->assertStatus(200);
    }

    public function testPagePhotosCity()
    {
        $this->get('/photos/cities/barcelona')->assertStatus(200);
    }

    public function testPagePhotosCountries()
    {
        $this->get('/photos/countries')->assertStatus(200);
    }

    public function testPagePhotosCountry()
    {
        $this->get('/photos/countries/russia')->assertStatus(200);
    }

    public function testPagePhotosMap()
    {
        $this->get('/photos/map')->assertStatus(200);
    }

    public function testPagePhotosTags()
    {
        $this->get('/photos/tags')->assertStatus(200);
    }

    public function testPagePhotosTag()
    {
        $this->get('/photos/tags/1')->assertStatus(200);
    }

    public function testPagePhotosTrips()
    {
        $this->get('/photos/trips')->assertStatus(200);
    }

    public function testPagePhotosTrip()
    {
        $this->get('/photos/trips/1')->assertStatus(200);
    }

    public function testPageCoupons()
    {
        $this->get('/promocodes-coupons')->assertStatus(200);
    }

    public function testPageCouponsAirbnb()
    {
        $this->get('/promocodes-coupons/airbnb')->assertStatus(200);
    }

    public function testPageCouponsDigitalOcean()
    {
        $this->get('/promocodes-coupons/digitalocean')->assertStatus(200);
    }

    public function testPageCouponsFirstvds()
    {
        $this->get('/promocodes-coupons/firstvds')->assertStatus(200);
    }

    public function testPageRetracker()
    {
        $this->get('/retracker')->assertStatus(200);
    }

    public function testPageRetrackerDev()
    {
        $this->get('/retracker/dev')->assertStatus(200);
    }

    public function testPageRetrackerUsage()
    {
        $this->get('/retracker/usage')->assertStatus(200);
    }

    public function testPageTorrent()
    {
        $this->get('/torrent')->assertStatus(200);
    }

    public function testPageTorrents()
    {
        $this->get('/torrents')->assertStatus(200);
    }

    public function testPageTorrentsComments()
    {
        $this->get('/torrents/comments')->assertStatus(200);
    }

    public function testPageTorrentsFaq()
    {
        $this->get('/torrents/faq')->assertStatus(200);
    }

    public function testPageUsers()
    {
        $this->get('/users')->assertStatus(200);
    }

    public function testPageUsersShow()
    {
        $this->get('/users/1')->assertStatus(200);
    }
}
