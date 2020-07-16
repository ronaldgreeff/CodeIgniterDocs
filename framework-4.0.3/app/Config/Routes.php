<?php namespace Config;

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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Each rule is a regular expression (left-side) mapped to a
// controller and method name separated by slashes (right-side)
// $routes->get('regex_exp', 'controller::method');

$routes->get('/', 'Home::index');
// ^ This directive says that any incoming request without any content specified 
// ("/") should be handled by the index() method inside the Home controller.

// ** Moved to bottom in Part 2 else executed first **
// $routes->get('(:any)', 'Pages::view/$1');
// ^ Here $routes (array) matches *any* request using wildcard string (:any)
// and passes the parameter to the view() method of Pages
// http://localhost:8080/home
//  ->  Pages.view('home')
// http://localhost:8080/about
//  ->  Pages.view('about')

// ** You can disable auto-routing by setting $routes->setAutoRoute(false); in
// the Routes.php file. This ensures that only routes you define can be accessed.

// PART 3
// We want CI to see `create` as a method, not a news item's slug
$routes->match(['get', 'post'], 'news/create', 'News::create');


// PART 2
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news', 'News::index');

$routes->get('(:any)', 'Pages::view/$1');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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
