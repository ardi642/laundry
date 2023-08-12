<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->get('api/Karyawan', 'API\Karyawan::selectDatatable');
$routes->post('api/Karyawan', 'API\Karyawan::create');
$routes->delete('api/Karyawan/(:any)', 'API\Karyawan::delete/$1');
$routes->put('api/Karyawan/(:any)', 'API\Karyawan::update/$1');

$routes->get('api/JenisPaket', 'API\JenisPaket::selectDatatable');
$routes->post('api/JenisPaket', 'API\JenisPaket::create');
$routes->delete('api/JenisPaket/(:any)', 'API\JenisPaket::delete/$1');
$routes->put('api/JenisPaket/(:any)', 'API\JenisPaket::update/$1');

$routes->get('api/Paket', 'API\Paket::selectDatatable');
$routes->post('api/Paket', 'API\Paket::create');
$routes->delete('api/Paket/(:any)', 'API\Paket::delete/$1');
$routes->put('api/Paket/(:any)', 'API\Paket::update/$1');

$routes->get('api/Order', 'API\Order::selectDatatable');
$routes->post('api/Order', 'API\Order::create');
$routes->delete('api/Order/(:any)', 'API\Order::delete/$1');
$routes->put('api/Order/(:any)', 'API\Order::update/$1');
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
