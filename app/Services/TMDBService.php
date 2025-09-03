<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;

class TMDBService {
    protected string $baseUrl = 'https://api.themoviedb.org/3/';
    protected string $apiKey;

    public function __construct(){
        $this->apiKey = config('services.tmdb.key');
    }

    public function getPopularMovies() {
        $response = Http::get($this->baseUrl . 'movie/popular', [
            'api_key' => $this->apiKey,
            'language' => 'en-US',
            'page' => 1
        ]);

        return $response->json();
    }

    public function searchMovies(string $query) {
        $response = Http::get($this->baseUrl . 'search/movie', [
            'api_key' => $this->apiKey,
            'query' => $query,
            'language' => 'en-US',
            'page' => 1
        ]);

        return $response->json();
    }
}