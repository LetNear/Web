<?php

use App\Controllers\User;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('/user/delete/(:num)', 'User::deleteUser/$1');
$routes->get('/user/edit/(:num)', 'User::editUser/$1');
$routes->post('/user/edit/(:num)', 'User::editUser/$1');
$routes->get('/user/create', 'User::createUser');
$routes->post('/user/create', 'User::createUser');

// APIS
$routes->get('/api/users', 'Api::users');
$routes->get('/api/users/(:num)', 'Api::getUser/$1');
$routes->delete('/api/users/(:num)', 'Api::deleteUser/$1');
$routes->post('/api/users', 'Api::createUser');
$routes->put('/api/users/(:num)', 'Api::updateUser/$1');





