<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Main::index');
$routes->get('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');
$routes->get('register', 'Auth::register');
$routes->get('profile', 'Auth::profile');
$routes->get('topup', 'Main::topup');
$routes->get('transaction', 'Main::transaction_service');
$routes->get('history', 'Main::transaction_history');
$routes->get('account', 'Main::akun');


$routes->post('login_proses', 'Auth::login_proses');
$routes->post('profile_proses', 'Auth::profile_proses');
$routes->post('profile_image_proses', 'Auth::profile_image_proses');
$routes->post('transaction_proses', 'Main::transaction_service_proses');
$routes->post('topup_proses', 'Main::topup_proses');