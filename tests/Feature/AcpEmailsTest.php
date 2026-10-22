<?php

namespace Tests\Feature;

use App\Factory\EmailFactory;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class AcpEmailsTest extends TestCase
{
    use BeAdmin;
    use DatabaseTransactions;

    public function testIndex(): void
    {
        EmailFactory::new()->withTripPublished()->create();

        $this->get('acp/emails')
            ->assertOk();
    }

    public function testShow(): void
    {
        $email = EmailFactory::new()->withTripPublished()->create();

        $this->get("acp/emails/{$email->id}")
            ->assertOk();
    }
}
