<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->get('/', 'Layout::index');

// Kategori
$routes->get('kategori', 'Kategori::index');

// Satuan
$routes->get('satuan', 'Satuan::index');

// Produk
$routes->get('produk', 'Produk::index');
$routes->get('produk/add', 'Produk::addProduk');
$routes->get('produk/edit/(:any)', 'Produk::editProduk/$1');

// Penjualan
$routes->get('kasir', 'Penjualan::index');