<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            App\Seeder\UploadsPruner::class,
            App\Seeder\UserSeeder::class,
            App\Seeder\ExternalIdentitySeeder::class,
            App\Seeder\ClientSeeder::class,
            App\Seeder\DomainSeeder::class,

            App\Seeder\CountrySeeder::class,
            App\Seeder\CitySeeder::class,
            App\Seeder\TripSeeder::class,
            App\Seeder\ArtistSeeder::class,
            App\Seeder\GigSeeder::class,
            App\Seeder\PhotoSeeder::class,

            App\Seeder\ChatMessageSeeder::class,
            App\Seeder\DcppHubSeeder::class,
            App\Seeder\IssueSeeder::class,
            App\Seeder\TagSeeder::class,
            App\Seeder\TorrentSeeder::class,
            App\Seeder\NewsSeeder::class,
            App\Seeder\ImageSeeder::class,

            App\Seeder\RadicalSeeder::class,
            App\Seeder\KanjiSeeder::class,
            App\Seeder\VocabularySeeder::class,
        ]);
    }
}
