<?php

use App\Factory\ArtistFactory;
use Illuminate\Database\Seeder;

class ArtistsSeeder extends Seeder
{
    private const ARTISTS = [
        ['slug' => 'davidgilmour', 'title' => 'David Gilmour'],
        ['slug' => 'dreamtheater', 'title' => 'Dream Theater'],
        ['slug' => 'giaa', 'title' => 'God is an Astronaut'],
        ['slug' => 'linkinpark', 'title' => 'Linkin Park'],
        ['slug' => 'metallica', 'title' => 'Metallica'],
        ['slug' => 'oomph', 'title' => 'Oomph'],
        ['slug' => 'opeth', 'title' => 'Opeth'],
        ['slug' => 'prodigy', 'title' => 'The Prodigy'],
        ['slug' => 'psy', 'title' => 'PSY'],
        ['slug' => 'rammstein', 'title' => 'Rammstein'],
        ['slug' => 'tfn', 'title' => 'Tides from Nebula'],
        ['slug' => 'vai', 'title' => 'Steve Vai'],
    ];

    public function run()
    {
        foreach (self::ARTISTS as $artist) {
            $model = ArtistFactory::new()->make();
            $model->slug = $artist['slug'];
            $model->title = $artist['title'];
            $model->save();
        }
    }
}
