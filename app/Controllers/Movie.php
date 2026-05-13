<?php

namespace App\Controllers;

use App\Models\FavoriteModel;

class Movie extends BaseController
{
    private $apiKey;
    private $baseUrl = 'https://api.themoviedb.org/3';
    public function __construct()
{
    $this->apiKey = env('TMDB_API_KEY');
}

    public function index($page = 1)
    {
        try {

            $client = \Config\Services::curlrequest();

            $response = $client->get($this->baseUrl . '/movie/popular', [

                'verify' => false,

                'query' => [

                    'api_key' => $this->apiKey,
                    'language' => 'en-US',
                    'page' => $page

                ]

            ]);

            $result = json_decode($response->getBody(), true);

            $data['movies'] = $result['results'];
            $data['currentPage'] = $page;

            return view('home', $data);

        } catch (\Exception $e) {

            return view('error_api');

        }
    }

    public function detail($id)
    {
        try {

            $client = \Config\Services::curlrequest();

            $response = $client->get($this->baseUrl . '/movie/' . $id, [

                'verify' => false,

                'query' => [

                    'api_key' => $this->apiKey,
                    'language' => 'en-US',
                    'append_to_response' => 'videos'

                ]

            ]);

            $data['movie'] = json_decode($response->getBody(), true);

            return view('detail', $data);

        } catch (\Exception $e) {

            return view('error_api');

        }
    }

    public function search()
    {
        try {

            $keyword = $this->request->getGet('keyword');

            $client = \Config\Services::curlrequest();

            $response = $client->get($this->baseUrl . '/search/movie', [

                'verify' => false,

                'query' => [

                    'api_key' => $this->apiKey,
                    'query' => $keyword

                ]

            ]);

            $result = json_decode($response->getBody(), true);

            $data['movies'] = $result['results'];
            $data['currentPage'] = 1;

            return view('home', $data);

        } catch (\Exception $e) {

            return view('error_api');

        }
    }

    public function genre($id)
    {
        try {

            $client = \Config\Services::curlrequest();

            $response = $client->get($this->baseUrl . '/discover/movie', [

                'verify' => false,

                'query' => [

                    'api_key' => $this->apiKey,
                    'with_genres' => $id

                ]

            ]);

            $result = json_decode($response->getBody(), true);

            $data['movies'] = $result['results'];
            $data['currentPage'] = 1;

            return view('home', $data);

        } catch (\Exception $e) {

            return view('error_api');

        }
    }

    public function favorite($id)
    {
        try {

            $client = \Config\Services::curlrequest();

            $response = $client->get($this->baseUrl . '/movie/' . $id, [

                'verify' => false,

                'query' => [

                    'api_key' => $this->apiKey

                ]

            ]);

            $movie = json_decode($response->getBody(), true);

            $favoriteModel = new FavoriteModel();

            $favoriteModel->save([

                'movie_id' => $movie['id'],
                'title' => $movie['title'],
                'poster' => $movie['poster_path'],
                'rating' => $movie['vote_average']

            ]);

            return redirect()->to('/favorites');

        } catch (\Exception $e) {

            return view('error_api');

        }
    }

    public function favorites()
    {
        try {

            $favoriteModel = new FavoriteModel();

            $data['movies'] = $favoriteModel->findAll();

            return view('favorites', $data);

        } catch (\Exception $e) {

            return view('error_api');

        }
    }

    public function deleteFavorite($id)
    {
        try {

            $favoriteModel = new FavoriteModel();

            $favoriteModel->delete($id);

            return redirect()->to('/favorites');

        } catch (\Exception $e) {

            return view('error_api');

        }
    }
}