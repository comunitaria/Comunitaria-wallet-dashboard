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
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::index');
$routes->get('/logout', 'Login::logout');
$routes->post('/login/olvido_clave', 'Login::olvido_clave');
$routes->get('/login/acceso_token', 'Login::acceso_token');

if (file_exists(ROOTPATH . 'modulos/vpconfig/Config/Routes.php')){
    require ROOTPATH . 'modulos/vpconfig/Config/Routes.php';
  }
  if (file_exists(ROOTPATH . 'modulos/vpbasicos/Config/Routes.php')){
    require ROOTPATH . 'modulos/vpbasicos/Config/Routes.php';
  }
  if (file_exists(ROOTPATH . 'modulos/pagina/Config/Routes.php')){
    require ROOTPATH . 'modulos/pagina/Config/Routes.php';
  }
  
 
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
