<?php

use Illuminate\Database\Seeder;

class DomainsSeeder extends Seeder
{
    // Подборка разных доменных зон для тестирования запросов whois
    private const DOMAINS = [
        'ivacuum.ru',
        'ivacuum.org',
        'vacuum.name',
        'korden.info',
        'korden.net',
        'ecoprof.su',
        'sanpropusknik.com',
        'ружейный.рф',
    ];

    public function run()
    {
        $clientIds = App\Client::get(['id'])->pluck('id');

        foreach (self::DOMAINS as $domain) {
            factory(App\Domain::class)->create([
                'domain' => $domain,
                'client_id' => $clientIds->random(),
            ]);
        }
    }
}
