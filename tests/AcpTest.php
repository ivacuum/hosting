<?php namespace Tests;

class AcpTest extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->be(\App\User::find(1));
    }

    public function testPageArtists()
    {
        $this->get('/acp/artists')->assertStatus(200);
    }

    public function testPageArtistsCreate()
    {
        $this->get('/acp/artists/create')->assertStatus(200);
    }

    public function testPageCities()
    {
        $this->get('/acp/cities')->assertStatus(200);
    }

    public function testPageCitiesCreate()
    {
        $this->get('/acp/cities/create')->assertStatus(200);
    }

    public function testPageClients()
    {
        $this->get('/acp/clients')->assertStatus(200);
    }

    public function testPageClientsCreate()
    {
        $this->get('/acp/clients/create')->assertStatus(200);
    }

    public function testPageComments()
    {
        $this->get('/acp/comments')->assertStatus(200);
    }

    public function testPageCountries()
    {
        $this->get('/acp/countries')->assertStatus(200);
    }

    public function testPageCountriesCreate()
    {
        $this->get('/acp/countries/create')->assertStatus(200);
    }

    public function testPageDomains()
    {
        $this->get('/acp/domains')->assertStatus(200);
    }

    public function testPageDomainsCreate()
    {
        $this->get('/acp/domains/create')->assertStatus(200);
    }

    public function testPageFiles()
    {
        $this->get('/acp/files')->assertStatus(200);
    }

    public function testPageFilesCreate()
    {
        $this->get('/acp/files/create')->assertStatus(200);
    }

    public function testPageGigs()
    {
        $this->get('/acp/gigs')->assertStatus(200);
    }

    public function testPageGigsCreate()
    {
        $this->get('/acp/gigs/create')->assertStatus(200);
    }

    public function testPageImages()
    {
        $this->get('/acp/images')->assertStatus(200);
    }

    public function testPageMetrics()
    {
        $this->get('/acp/metrics')->assertStatus(200);
    }

    public function testPageNews()
    {
        $this->get('/acp/news')->assertStatus(200);
    }

    public function testPageNewsCreate()
    {
        $this->get('/acp/news/create')->assertStatus(200);
    }

    public function testPagePhotos()
    {
        $this->get('/acp/photos')->assertStatus(200);
    }

    public function testPagePhotosCreate()
    {
        $this->get('/acp/photos/create')->assertStatus(200);
    }

    public function testPageServers()
    {
        $this->get('/acp/servers')->assertStatus(200);
    }

    public function testPageServersCreate()
    {
        $this->get('/acp/servers/create')->assertStatus(200);
    }

    public function testPageTags()
    {
        $this->get('/acp/tags')->assertStatus(200);
    }

    public function testPageTagsCreate()
    {
        $this->get('/acp/tags/create')->assertStatus(200);
    }

    public function testPageTorrents()
    {
        $this->get('/acp/torrents')->assertStatus(200);
    }

    public function testPageTrips()
    {
        $this->get('/acp/trips')->assertStatus(200);
    }

    public function testPageTripsCreate()
    {
        $this->get('/acp/trips/create')->assertStatus(200);
    }

    public function testPageUsers()
    {
        $this->get('/acp/users')->assertStatus(200);
    }

    public function testPageYandexUsers()
    {
        $this->get('/acp/yandex-users')->assertStatus(200);
    }

    public function testPageYandexUsersCreate()
    {
        $this->get('/acp/yandex-users/create')->assertStatus(200);
    }
}
