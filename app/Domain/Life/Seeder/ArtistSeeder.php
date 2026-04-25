<?php

namespace App\Domain\Life\Seeder;

use App\Domain\Life\Factory\ArtistFactory;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    private const array ARTISTS = [
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
        foreach (self::ARTISTS as [
            'slug' => $slug,
            'title' => $title,
        ]) {
            $artist = ArtistFactory::new()->make();
            $artist->slug = $slug;
            $artist->title = $title;
            $artist->save();
        }
    }
}
