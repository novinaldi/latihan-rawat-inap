<?php

namespace Config;

// Create a new instance of our RouteCollection class.
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Layout::index');
// $routes->get('/coba', 'Coba::biodata');
$routes->get('/coba/(:any)', 'Coba::biodata/$1');

$routes->get('/anggota/hapus/(:any)', 'Anggota::index');
$routes->delete('/anggota/hapus/(:any)', 'Anggota::hapus/$1');

// Routes Pasien
$routes->get('/pasien/(:any)', 'Master\Pasien::$1');
$routes->get('/pasien/index', 'Master\Pasien::index');
$routes->post('/pasien/index', 'Master\Pasien::index');
$routes->get('/pasien', 'Master\Pasien::index');
$routes->get('/pasien/hapus/(:any)', 'Master\Pasien::index');
$routes->delete('/pasien/hapus/(:any)', 'Master\Pasien::hapus/$1');
$routes->post('/pasien/simpan', 'Master\Pasien::simpan');
$routes->post('/pasien/update', 'Master\Pasien::update');

$routes->group('penyakit', function ($routes) {
	$routes->get('/', 'Master\Penyakit::index');
	$routes->get('index', 'Master\Penyakit::index');
	$routes->post('index', 'Master\Penyakit::index');
	$routes->delete('hapus/(:any)', 'Master\Penyakit::hapus/$1');
});
$routes->group('kamar', function ($routes) {
	$routes->get('/', 'Master\Kamar::index');
	$routes->get('index', 'Master\Kamar::index');
	$routes->post('index', 'Master\Kamar::index');
	$routes->delete('hapus/(:any)', 'Master\Kamar::hapus/$1');
});
/**
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