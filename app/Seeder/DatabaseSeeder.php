<?php

namespace App\Seeder;

use App\Domain\Wanikani\Seeder\KanjiSeeder;
use App\Domain\Wanikani\Seeder\RadicalSeeder;
use App\Domain\Wanikani\Seeder\VocabularySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            PruneUploads::class,
            PruneSearchIndexes::class,
            PruneCache::class,
            PruneLogs::class,

            UserSeeder::class,
            ExternalIdentitySeeder::class,

            CountrySeeder::class,
            CitySeeder::class,
            TripSeeder::class,
            ArtistSeeder::class,
            GigSeeder::class,
            PhotoSeeder::class,

            ChatMessageSeeder::class,
            DcppHubSeeder::class,
            IssueSeeder::class,
            FileSeeder::class,
            TagSeeder::class,
            MagnetSeeder::class,
            NewsSeeder::class,
            ImageSeeder::class,
            FavoriteMovieSeeder::class,
            MetricSeeder::class,
            GameSeeder::class,

            RadicalSeeder::class,
            KanjiSeeder::class,
            VocabularySeeder::class,
        ]);
    }
}
