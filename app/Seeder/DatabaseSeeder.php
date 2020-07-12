<?php namespace App\Seeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UploadsPruner::class,
            UserSeeder::class,
            ExternalIdentitySeeder::class,
            ClientSeeder::class,
            DomainSeeder::class,

            CountrySeeder::class,
            CitySeeder::class,
            TripSeeder::class,
            ArtistSeeder::class,
            GigSeeder::class,
            PhotoSeeder::class,

            ChatMessageSeeder::class,
            DcppHubSeeder::class,
            IssueSeeder::class,
            TagSeeder::class,
            TorrentSeeder::class,
            NewsSeeder::class,
            ImageSeeder::class,
            FavoriteMovieSeeder::class,

            RadicalSeeder::class,
            KanjiSeeder::class,
            VocabularySeeder::class,
        ]);
    }
}
