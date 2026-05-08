<?php

namespace App\Controllers;
use App\Models\FavoriteModel;

class Movie extends BaseController
{
    private $apiKey = 'c67f3073212a259f86df2def996c230d';
    private $baseUrl = 'https://api.themoviedb.org/3';


    //INDEX
    public function index($page = 1)
{
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
}


//DETAIL
    public function detail($id)
{
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
}


//SEARCH
    public function search()
{
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

    // tambahkan ini
    $data['currentPage'] = 1;

    return view('home', $data);
}

//GENDRE
public function genre($id)
{
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
}

//FAVORITE
public function favorite($id)
{
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

    return redirect()->to('/');
}

public function favorites()
{
    $favoriteModel = new FavoriteModel();

    $data['movies'] = $favoriteModel->findAll();

    return view('favorites', $data);
}

public function deleteFavorite($id)
{
    $favoriteModel = new FavoriteModel();

    $favoriteModel->delete($id);

    return redirect()->to('/favorites');
}
}