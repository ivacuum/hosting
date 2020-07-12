<?php namespace App\Http\Controllers;

use App\FavoriteMovie;

class MoviesController extends Controller
{
    public function __invoke()
    {
        return view('life.movies', [
            'moviesByYears' => FavoriteMovie::query()
                ->orderByDesc('year')
                ->orderByDesc('title_en')
                ->get()
                ->groupBy('year'),
        ]);
    }
}
