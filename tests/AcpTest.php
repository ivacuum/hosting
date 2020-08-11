<?php namespace Tests;

use App\Factory\UserFactory;

class AcpTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testRoot()
    {
        $this->get('acp')->assertStatus(200);
    }

    public function testPageClients()
    {
        $this->get('acp/clients')->assertStatus(200);
    }

    public function testPageClientsCreate()
    {
        $this->get('acp/clients/create')->assertStatus(200);
    }

    public function testPageComments()
    {
        $this->get('acp/comments')->assertStatus(200);
    }

    public function testPageDomains()
    {
        $this->get('acp/domains')->assertStatus(200);
    }

    public function testPageDomainsCreate()
    {
        $this->get('acp/domains/create')->assertStatus(200);
    }

    public function testPageFiles()
    {
        $this->get('acp/files')->assertStatus(200);
    }

    public function testPageFilesCreate()
    {
        $this->get('acp/files/create')->assertStatus(200);
    }

    public function testPageImages()
    {
        $this->get('acp/images')->assertStatus(200);
    }

    public function testPageMetrics()
    {
        $this->get('acp/metrics')->assertStatus(200);
    }

    public function testPagePhotos()
    {
        $this->get('acp/photos')->assertStatus(200);
    }

    public function testPagePhotosCreate()
    {
        $this->get('acp/photos/create')->assertStatus(200);
    }

    public function testPageServers()
    {
        $this->get('acp/servers')->assertStatus(200);
    }

    public function testPageServersCreate()
    {
        $this->get('acp/servers/create')->assertStatus(200);
    }

    public function testPageTorrents()
    {
        $this->get('acp/torrents')->assertStatus(200);
    }

    public function testPageUsers()
    {
        $this->get('acp/users')->assertStatus(200);
    }

    public function testPageYandexUsers()
    {
        $this->get('acp/yandex-users')->assertStatus(200);
    }

    public function testPageYandexUsersCreate()
    {
        $this->get('acp/yandex-users/create')->assertStatus(200);
    }
}
