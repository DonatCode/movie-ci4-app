<?php

namespace App\Controllers;

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



}