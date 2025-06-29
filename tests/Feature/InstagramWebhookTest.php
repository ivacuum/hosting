<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InstagramWebhookTest extends TestCase
{
    use DatabaseTransactions;

    public function testEvent()
    {
        $this->post('instagram/webhook', [
            'entry' => [
                [
                    'time' => now()->timestamp,
                    'changes' => [
                        [
                            'field' => 'photos',
                            'value' => [
                                'verb' => 'update',
                                'object_id' => '1234567890',
                            ],
                        ],
                    ],
                    'id' => '123456789',
                    'uid' => '12345678',
                ],
            ],
            'object' => 'user',
        ])->assertOk();
    }

    public function testVerify()
    {
        config(['services.instagram.webhook_verify_token' => 'xxx']);

        $response = $this->get('instagram/webhook?hub.mode=subscribe&hub.challenge=1234567890&hub.verify_token=xxx')
            ->assertOk();

        $this->assertSame('1234567890', $response->content());
    }
}
