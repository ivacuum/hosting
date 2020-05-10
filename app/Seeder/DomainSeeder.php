<?php namespace App\Seeder;

use App\Client;
use App\Factory\DomainFactory;
use Illuminate\Database\Seeder;

class DomainSeeder extends Seeder
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
        $clientIds = Client::pluck('id');

        foreach (self::DOMAINS as $domain) {
            DomainFactory::new()
                ->withClientId($clientIds->random())
                ->withDomain($domain)
                ->create();
        }
    }
}
