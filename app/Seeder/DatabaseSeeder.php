<?php

namespace App\Seeder;

use App\Domain\Dcpp\Seeder\DcppHubSeeder;
use App\Domain\Game\Seeder\GameSeeder;
use App\Domain\Life\Seeder\ArtistSeeder;
use App\Domain\Life\Seeder\CitySeeder;
use App\Domain\Life\Seeder\CountrySeeder;
use App\Domain\Life\Seeder\GigSeeder;
use App\Domain\Life\Seeder\PhotoSeeder;
use App\Domain\Life\Seeder\TagSeeder;
use App\Domain\Life\Seeder\TripSeeder;
use App\Domain\Magnet\Seeder\MagnetSeeder;
use App\Domain\Metrics\Seeder\MetricSeeder;
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
