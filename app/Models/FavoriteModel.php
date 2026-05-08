<?php

namespace App\Models;

use CodeIgniter\Model;

class FavoriteModel extends Model
{
    protected $table = 'favorites';

    protected $allowedFields = [
        'movie_id',
        'title',
        'poster',
        'rating'
    ];
}