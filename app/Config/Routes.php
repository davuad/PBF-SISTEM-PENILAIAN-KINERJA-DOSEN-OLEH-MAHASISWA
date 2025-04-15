<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/api/mahasiswa', 'Mahasiswa::index');
$routes->get('/api/dosen', 'Dosen::index');
$routes->get('/api/prodi', 'Prodi::index');
$routes->get('/api/matkul', 'Matkul::index');
$routes->get('/api/admin', 'Admin::index');
$routes->get('/api/penilaian', 'Penilaian::index');


$routes->post('/api/mahasiswa/create', 'Mahasiswa::create');
$routes->post('/api/prodi/create', 'Prodi::create');
$routes->post('/api/matkul/create', 'Matkul::create');
$routes->post('/api/dosen/create', 'Dosen::create');
$routes->post('api/penilaian/create', 'Penilaian::create');