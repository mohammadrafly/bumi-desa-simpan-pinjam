<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'UserController::index');
$routes->post('login', 'UserController::login');
$routes->get('register', 'UserController::register');
$routes->post('register', 'UserController::store');
$routes->get('logout', 'UserController::logout');

$routes->group('dashboard', ['filter' => 'authGuard'], function ($routes) {
    $routes->get('/', 'DashboardController::index');
    $routes->group('profile', function ($routes) {
        $routes->get('u/(:num)', 'ProfileController::index/$1');
        $routes->post('update', 'ProfileController::update');
        $routes->get('faq', 'ProfileController::faq');
    });
    $routes->get('laporan', 'DashboardController::laporan' );
    $routes->group('my/permohonan', function ($routes) {
        $routes->get('u/(:num)', 'PermohonanController::indexPersonal/$1');
        $routes->get('u/(:num)/new', 'PermohonanController::addPersonal/$1');
        $routes->post('u/(:num)/new/store', 'PermohonanController::storePersonal/$1');
    });
    $routes->group('my/transaksi', function ($routes) {
        $routes->get('u/(:num)/simpanan', 'SimpananController::indexPersonal/$1');
        $routes->get('u/(:num)/pinjaman', 'PinjamanController::indexPersonal/$1');
        $routes->get('u/(:num)/angsuran', 'AngsuranController::indexPersonal/$1');
        $routes->get('u/(:num)/penarikan/id/(:num)', 'PenarikanController::indexPersonal/$1/$2');
        $routes->get('u/(:num)/pembayaran/id/(:num)', 'PembayaranController::indexPersonal/$1/$2');
    });
    $routes->group('pengguna', ['filter' => 'backEndGuard'], function ($routes) {
        $routes->get('/', 'PenggunaController::index');
        $routes->get('add', 'PenggunaController::add');
        $routes->post('store', 'PenggunaController::store');
        $routes->get('edit/(:num)', 'PenggunaController::edit/$1');
        $routes->post('update', 'PenggunaController::update');
        $routes->get('delete/(:num)/', 'PenggunaController::delete/$1');
        $routes->get('export', 'PenggunaController::export');
        $routes->get('ganti/password/(:num)', 'PenggunaController::gantiPassword/$1');
        $routes->post('ganti/password/store', 'PenggunaController::updatePassword');
    });
    $routes->group('anggota', ['filter' => 'backEndGuard'], function ($routes) {
        $routes->get('/', 'AnggotaController::index');
        /*
         *$routes->get('add', 'AnggotaController::add');
         *$routes->post('store', 'AnggotaController::store');
         *$routes->get('edit/(:num)', 'AnggotaController::edit/$1');
         *$routes->post('update', 'AnggotaController::update');
         *$routes->get('delete/(:num)/', 'AnggotaController::delete/$1');
        */
        $routes->get('export', 'AnggotaController::export');
        
    });
    $routes->group('permohonan', ['filter' => 'backEndGuard'], function ($routes) {
        $routes->get('/', 'PermohonanController::index');
        $routes->get('add', 'PermohonanController::add');
        $routes->post('store', 'PermohonanController::store');
        $routes->get('edit/(:num)', 'PermohonanController::edit/$1');
        $routes->post('update', 'PermohonanController::update');
        $routes->get('delete/(:num)', 'PermohonanController::delete/$1');
        $routes->get('export', 'PermohonanController::export');
    });
    $routes->group('transaksi', ['filter' => 'backEndGuard'], function ($routes) {
        $routes->get('/', 'TransaksiController::index');
        $routes->group('pinjaman', function ($routes) {
            $routes->get('pengguna/(:num)', 'PinjamanController::index/$1');
            $routes->get('add/(:num)', 'PinjamanController::add/$1');
            $routes->post('store', 'PinjamanController::store');
            $routes->get('edit/(:num)/(:num)', 'PinjamanController::edit/$1/$2');
            $routes->post('update', 'PinjamanController::update');
            $routes->get('delete/(:num)/(:num)', 'PinjamanController::delete/$1/$2');
            $routes->get('export', 'PinjamanController::export');
            $routes->get('view/(:num)/(:num)', 'PinjamanController::view/$1/$2');
            $routes->get('pdf/(:num)', 'PinjamanController::pdf/$1');
        });
        $routes->group('simpanan', function ($routes) {
            $routes->get('pengguna/(:num)', 'SimpananController::index/$1');
            $routes->get('add/(:num)', 'SimpananController::add/$1');
            $routes->post('store', 'SimpananController::store');
            $routes->get('edit/(:num)/(:num)', 'SimpananController::edit/$1/$2');
            $routes->post('update/(:num)', 'SimpananController::update/$1');
            $routes->get('delete/(:num)/(:num)', 'SimpananController::delete/$1/$2');
            $routes->get('export', 'SimpananController::export');
            $routes->get('view/(:num)/(:num)', 'SimpananController::view/$1/$2');
            $routes->get('pdf/(:num)', 'SimpananController::pdf/$1');
        });
        $routes->group('angsuran', function ($routes) {
            $routes->get('pengguna/(:num)', 'AngsuranController::index/$1');
            $routes->get('add/(:num)', 'AngsuranController::add/$1');
            $routes->post('store', 'AngsuranController::store');
            $routes->get('edit/(:num)/(:num)', 'AngsuranController::edit/$1/$2');
            $routes->post('update', 'AngsuranController::update');
            $routes->get('delete/(:num)/(:num)', 'AngsuranController::delete/$1/$2');
            $routes->get('export', 'AngsuranController::export');
            $routes->get('view/(:num)', 'AngsuranController::view/$1');
            $routes->get('pdf/(:num)', 'AngsuranController::pdf/$1');
        });
        $routes->group('pembayaran', function ($routes) {
            $routes->get('angsuran/(:num)', 'PembayaranController::index/$1');
            $routes->get('add/(:num)', 'PembayaranController::add/$1');
            $routes->post('store', 'PembayaranController::store');
            $routes->get('edit/(:num)', 'PembayaranController::edit/$1');
            $routes->post('update', 'PembayaranController::update');
            $routes->get('delete/(:num)', 'PembayaranController::delete/$1');
            $routes->get('export', 'PembayaranController::export');
            $routes->get('view/(:num)', 'PembayaranController::view/$1');
            $routes->get('pdf/(:num)', 'PembayaranController::pdf/$1');
        });
        $routes->group('penarikan', function ($routes) {
            $routes->get('simpanan/(:num)', 'PenarikanController::index/$1');
            $routes->get('add/(:num)/(:num)/(:num)', 'PenarikanController::add/$1/$2/$3');
            $routes->post('store', 'PenarikanController::store');
            $routes->get('edit/(:num)', 'PenarikanController::edit/$1');
            $routes->post('update', 'PenarikanController::update');
            $routes->get('delete/(:num)/(:num)', 'PenarikanController::delete/$1/$2');
            $routes->get('export', 'PenarikanController::export');
            $routes->get('view/(:num)/(:num)', 'PenarikanController::view/$1/$2');
            $routes->get('pdf/(:num)', 'PenarikanController::pdf/$1');
        });
    });
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
