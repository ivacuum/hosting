<?php namespace Tests\Feature;

use App\Factory\ExternalIdentityFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpExternalIdentitiesTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testIndex()
    {
        ExternalIdentityFactory::new()->create();

        $this->get('acp/external-identities')
            ->assertOk();
    }

    public function testShow()
    {
        $externalIdentity = ExternalIdentityFactory::new()->create();

        $this->get("acp/external-identities/{$externalIdentity->id}")
            ->assertOk();
    }
}
