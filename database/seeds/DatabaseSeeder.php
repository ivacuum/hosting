<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	public function run()
	{
	    $this->call([
            UsersSeeder::class,
            ClientsSeeder::class,
            DomainsSeeder::class,

            CountriesSeeder::class,
            CitiesSeeder::class,
            TripsSeeder::class,
            ArtistsSeeder::class,
            GigsSeeder::class,

            TagsSeeder::class,
            NewsSeeder::class,

            RadicalSeeder::class,
            KanjiSeeder::class,
            VocabularySeeder::class,
        ]);
	}
}
