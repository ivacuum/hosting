<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class SiteTest extends TestCase
{
    use DatabaseMigrations;

    public function testPages()
    {
        $this->get('/')->assertResponseOk();
        $this->get('/about')->assertResponseOk();
        $this->get('/docs')->assertResponseOk();
        $this->get('/life')->assertResponseOk();
        $this->get('/life/cities')->assertResponseOk();
        $this->get('/life/countries')->assertResponseOk();
        $this->get('/life/gigs')->assertResponseOk();
    }

    public function testTripsTemplates()
    {
        $this->be(App\User::find(1));

        foreach (App\Trip::templatesIterator() as $template) {
            $this->get("/acp/dev/templates/{$template->getBasename('.blade.php')}")
                ->assertResponseOk();
        }
    }

    public function testAcpPages()
    {
        $this->be(App\User::find(1));

        $this->get('/acp/cities')->assertResponseOk();
        $this->get('/acp/cities/create')->assertResponseOk();

        $this->get('/acp/clients')->assertResponseOk();
        $this->get('/acp/clients/create')->assertResponseOk();

        $this->get('/acp/countries')->assertResponseOk();
        $this->get('/acp/countries/create')->assertResponseOk();

        $this->get('/acp/domains')->assertResponseOk();
        $this->get('/acp/domains/create')->assertResponseOk();

        $this->get('/acp/gigs')->assertResponseOk();
        $this->get('/acp/gigs/create')->assertResponseOk();

        $this->get('/acp/servers')->assertResponseOk();
        $this->get('/acp/servers/create')->assertResponseOk();

        $this->get('/acp/trips')->assertResponseOk();
        $this->get('/acp/trips/create')->assertResponseOk();

        $this->get('/acp/users')->assertResponseOk();
        $this->get('/acp/users/create')->assertResponseOk();

        $this->get('/acp/yandex/users')->assertResponseOk();
        $this->get('/acp/yandex/users/create')->assertResponseOk();

    }
}
