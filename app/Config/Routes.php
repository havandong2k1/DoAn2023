<?php

namespace Config;

// Create a new instance of our RouteCollection class.
use App\Controllers\Student_Controller;

$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->get('/', 'Home::login', ['filter' => 'noauth']);

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}

/*Home.php*/
$routes->group('home', function ($routes) {
    /*Login action*/
    $routes->get('login', 'Home::login', ['filter' => 'noauth']);
    /*Logout action*/
    $routes->get('logout', 'Home::logout', ['filter' => 'auth']);
});
$routes->group('admin', function ($routes) {
    $routes->get('home-list','Admin\HomeController::index');
    $routes->get('view-list', 'StudentController::index');
    $routes->get('add-list', 'StudentController::create');
    $routes->post('submit-list','StudentController::store');
    $routes->get('edit-list/(:num)','StudentController::edit/$1');
    $routes->post('update-list','StudentController::update');
    $routes->post('delete-list/(:num)','StudentController::deleteStudent/$1');
});

$routes->group('api-tax', function ($routes) {
    $routes->post('get-users', 'ApiTax::getListusers', ['filter' => 'apiclientauth']);
    $routes->post('demo-list', 'ApiTax::getStudentList', ['filter' => 'studentauth']);
    //$routes->post('get-users','StudentController::update');
});
