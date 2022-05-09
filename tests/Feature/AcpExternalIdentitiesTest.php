<?php namespace Tests\Feature;

use App\Factory\ExternalIdentityFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpExternalIdentitiesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

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
