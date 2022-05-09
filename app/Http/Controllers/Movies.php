<?php namespace App\Http\Controllers;

use App\FavoriteMovie;

class Movies
{
    public function __invoke()
    {
        return view('life.movies', [
            'moviesByYears' => FavoriteMovie::query()
                ->orderByDesc('year')
                ->orderBy('title_en')
                ->get()
                ->groupBy('year'),
        ]);
    }
}
