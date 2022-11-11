<?php namespace Tests\Feature;

use App\Factory\EmailFactory;
use App\Factory\UserFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpEmailsTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $this->be(UserFactory::new()->admin()->make());
    }

    public function testIndex()
    {
        EmailFactory::new()->withTripPublished()->create();

        $this->get('acp/emails')
            ->assertOk();
    }

    public function testShow()
    {
        $email = EmailFactory::new()->withTripPublished()->create();

        $this->get("acp/emails/{$email->id}")
            ->assertOk();
    }
}
