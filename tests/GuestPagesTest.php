<?php

namespace Tests;

use PHPUnit\Framework\Attributes\TestWith;

class GuestPagesTest extends TestCase
{
    #[TestWith(['/auth/login'])]
    #[TestWith(['/auth/register'])]
    #[TestWith(['/auth/password/remind'])]
    #[TestWith(['/docs'])]
    #[TestWith(['/docs/amazon-s3'])]
    #[TestWith(['/docs/freebsd'])]
    #[TestWith(['/docs/nginx'])]
    #[TestWith(['/docs/trips'])]
    #[TestWith(['/retracker'])]
    #[TestWith(['/retracker/dev'])]
    #[TestWith(['/retracker/usage'])]
    #[TestWith(['/subscriptions'])]
    public function testGuestPages200(string $url)
    {
        $this->get($url)->assertOk();
    }

    public function testIp()
    {
        $this->get('ip', [
            'REMOTE_ADDR' => '1.2.3.4',
            'HTTP_CF_IPCOUNTRY' => 'XX',
        ])
            ->assertOk()
            ->assertExactJson([
                'ip' => '1.2.3.4',
                'country' => 'XX',
            ]);
    }
}
