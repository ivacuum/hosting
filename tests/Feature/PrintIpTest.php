<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class PrintIpTest extends TestCase
{
    use DatabaseTransactions;

    public function testGeoIpCountry(): void
    {
        $this
            ->withServerVariables([
                'REMOTE_ADDR' => '198.51.100.10',
                'COUNTRY_ALPHA2' => 'WW',
            ])
            ->get('ip')
            ->assertOk()
            ->assertExactJson([
                'ip' => '198.51.100.10',
                'country' => 'WW',
            ]);
    }

    public function testIpAndCloudflareCountry(): void
    {
        $this
            ->withServerVariables([
                'REMOTE_ADDR' => '198.51.100.10',
                'HTTP_CF_IPCOUNTRY' => 'RS',
            ])
            ->get('ip')
            ->assertOk()
            ->assertExactJson([
                'ip' => '198.51.100.10',
                'country' => 'RS',
            ]);
    }
}
