<?php

class SiteTest extends TestCase
{
    public function testPages()
    {
        $this->visit('/');
        $this->visit('/about');
        $this->visit('/docs');
        $this->visit('/life');
        $this->visit('/life/cities');
        $this->visit('/life/countries');
        $this->visit('/life/gigs');
    }

    public function testAcpPages()
    {
        $this->visit('/acp/cities');
        $this->visit('/acp/cities/create');

        $this->visit('/acp/clients');
        $this->visit('/acp/clients/create');

        $this->visit('/acp/countries');
        $this->visit('/acp/countries/create');

        $this->visit('/acp/domains');
        $this->visit('/acp/domains/create');

        $this->visit('/acp/gigs');
        $this->visit('/acp/gigs/create');

        $this->visit('/acp/servers');
        $this->visit('/acp/servers/create');

        $this->visit('/acp/trips');
        $this->visit('/acp/trips/create');

        $this->visit('/acp/users');
        $this->visit('/acp/users/create');

        $this->visit('/acp/yandex/users');
        $this->visit('/acp/yandex/users/create');

    }
}
