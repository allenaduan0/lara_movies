<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    protected TMDBService $tmdb;

    public function __construct(TMDBService $tmdb){
        $this->tmdb = $tmdb;
    }

    public function index() {
        $movies = $this->tmdb->getPopularMovies();

        return view('movies.index', [
            'movies' => $movies['results'] ?? [],
        ]);
    }

    public function search(Request $request){
        $request->validate([
            'query' => 'required|string|max:100',
        ]);

        $results = $this->tmdb->searchMovies($request->query('query'));

        return view('movies.index', [
            'movies' => $results['results'] ?? [],
        ]);
    }
}