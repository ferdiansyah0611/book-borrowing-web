<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->group('analytics', ['filter' => 'authorize'], function($routes){
    $routes->get('book', 'ChartController::book');
    $routes->get('borrowed', 'ChartController::borrowed');
});
$routes->group('auth', function($routes){
    $routes->match(['get', 'post'], 'signin', 'AuthController::login', ['as' => 'login']);
    $routes->match(['get', 'post'], 'signup', 'AuthController::register', ['as' => 'register']);
    $routes->get('logout', 'AuthController::logout', ['as' => 'logout', 'filter' => 'authorize']);
});
$routes->group('', ['filter' => 'authorize'], function($routes){
    $routes->get('/', 'Home::index');
    $routes->match(['get', 'post'], '/profile', 'UserController::profile');
    $routes->resource('book', ['controller' => 'BookController', 'except' => 'show,update']);
    $routes->resource('ebook', ['controller' => 'EbookController', 'except' => 'show,update']);
    $routes->resource('borrow-book', ['controller' => 'Borrowbooks', 'except' => 'show,update']);
    $routes->resource('user', ['controller' => 'UserController', 'filter' => 'admin', 'except' => 'show,update']);
    $routes->get('book/json', 'BookController::json');
    $routes->get('ebook/json', 'EbookController::json');
    $routes->get('borrow-book/json', 'Borrowbooks::json');
    $routes->get('ebook/json', 'EbookController::json');
    $routes->get('user/json', 'UserController::json');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
