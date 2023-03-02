<?php

return [
    [
        'label' => 'Beranda',
        'icon' => 'heroicon-o-cube-transparent',
        'route_name' => 'dashboard',
    ],
    [
        'label' => 'Artikel',
        'icon' => 'heroicon-o-document-text',
        'route_name' => 'articles.index',
        'permission' => 'articles-read',
    ],
    [
        'label' => 'Komoditas',
        'icon' => 'heroicon-o-cash',
        'route_name' => 'commodities.index',
        'permission' => 'commodities-read',
    ],
    [
        'label' => 'Galeri',
        'icon' => 'heroicon-o-photograph',
        'route_name' => 'galleries.index',
        'permission' => 'galleries-read',
    ],
    [
        'label' => 'Halaman',
        'icon' => 'heroicon-o-collection',
        'route_name' => 'pages.index',
        'permission' => 'pages-read',
    ],
    [
        'label' => 'Pengguna',
        'icon' => 'heroicon-o-users',
        'route_name' => 'users.index',
        'permission' => 'users-read',
    ],
    [
        'label' => 'Peta Rawan Pangan',
        'icon' => 'heroicon-o-map',
        'route_name' => 'rawan-pangan.index',
        'permission' => 'rawan-pangan-read',
    ],
    [
        'label' => 'SKPG',
        'icon' => 'heroicon-o-database',
        'route_name' => 'skpg.index',
    ],
    [
        'label' => 'Data KWT',
        'icon' => 'heroicon-o-user-group',
        'route_name' => 'kelompok-tani.index',
        'permission' => 'kelompok-tani-read',
    ],
    [
        'label' => 'Pengaturan',
        'icon' => 'heroicon-o-cog',
        'route_name' => 'settings.index',
    ],
];
