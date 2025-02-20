<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Main::zlinskykraj');
$routes->get('zlinskykraj', 'Main::zlinskykraj');
$routes->get("okres/(:num)/perPage/(:num)", "Main::okres/$1/$2");