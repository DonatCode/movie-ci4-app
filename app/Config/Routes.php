<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Movie::index');
$routes->get('/detail/(:num)', 'Movie::detail/$1');
$routes->get('/search', 'Movie::search');

//pagination
$routes->get('/page/(:num)', 'Movie::index/$1');

//gendre
$routes->get('/genre/(:num)', 'Movie::genre/$1');

