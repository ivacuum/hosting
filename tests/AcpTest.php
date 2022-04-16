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
        $this->get('acp')->assertOk();
    }

    public function testPageClients()
    {
        $this->get('acp/clients')->assertOk();
    }

    public function testPageClientsCreate()
    {
        $this->get('acp/clients/create')->assertOk();
    }

    public function testPageComments()
    {
        $this->get('acp/comments')->assertOk();
    }

    public function testPageDomains()
    {
        $this->get('acp/domains')->assertOk();
    }

    public function testPageDomainsCreate()
    {
        $this->get('acp/domains/create')->assertOk();
    }

    public function testPageFiles()
    {
        $this->get('acp/files')->assertOk();
    }

    public function testPageFilesCreate()
    {
        $this->get('acp/files/create')->assertOk();
    }

    public function testPageImages()
    {
        $this->get('acp/images')->assertOk();
    }

    public function testPageMagnets()
    {
        $this->get('acp/magnets')->assertOk();
    }

    public function testPageMetrics()
    {
        $this->get('acp/metrics')->assertOk();
    }

    public function testPageServers()
    {
        $this->get('acp/servers')->assertOk();
    }

    public function testPageServersCreate()
    {
        $this->get('acp/servers/create')->assertOk();
    }

    public function testPageYandexUsers()
    {
        $this->get('acp/yandex-users')->assertOk();
    }

    public function testPageYandexUsersCreate()
    {
        $this->get('acp/yandex-users/create')->assertOk();
    }
}
