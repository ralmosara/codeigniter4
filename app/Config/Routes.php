<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'News::index');

$routes->match(['get', 'post'], 'news/create','News::create');
$routes->match(['post'], 'news/update','News::update');
$routes->get('news/(:segment)', 'News::view/$1');
$routes->get('news/edit/(:segment)', 'News::edit/$1');
$routes->get('news', 'News::index');


