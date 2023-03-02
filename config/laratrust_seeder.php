<?php

return [
    /**
     * Control if the seeder should create a user per role while seeding the data.
     */
    'create_users' => false,

    /**
     * Control if all the laratrust tables should be truncated before running the seeder.
     */
    'truncate_tables' => true,

    'roles_structure' => [
        'administrator' => [
            'articles' => 'c,r,u,d',
            'categories' => 'c,r,u,d',
            'commodities' => 'c,r,u,d',
            'files' => 'c,r,u,d',
            'galleries' => 'c,r,u,d',
            'menus' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'rawan-pangan' => 'c,r,u,d',
            'kelompok-tani' => 'c,r,u,d',
            'users' => 'c,r,u,d',
        ],
        'dcp' => [
            'articles' => 'c,r,u,d',
            'commodities' => 'c,r,u,d',
            'galleries' => 'c,r,u,d',
            'rawan-pangan' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'settings' => 'r',
        ],
        'kkp' => [
            'articles' => 'c,r,u,d',
            'galleries' => 'c,r,u,d',
            'kelompok-tani' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'settings' => 'r',
        ],
        'subscriber' => [
        ],
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ]
];
