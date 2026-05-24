<?php

return [

    'defaults' => [
        'guard' => 'masyarakat',
        'passwords' => 'masyarakat',
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'users',
        ],
         'petugas' => [
            'driver'   => 'session',
            'provider' => 'petugas',
        ],

        // Guard untuk masyarakat (user umum)
        'masyarakat' => [
            'driver'   => 'session',
            'provider' => 'masyarakat',
        ],

    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model'  => App\Models\User::class,
        ],

        'masyarakat' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Masyarakat::class,
        ],

        'petugas' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Petugas::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 2,
        ],
        'masyarakat' => [
            'provider' => 'masyarakat',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 2,
        ],
        'petugas' => [
            'provider' => 'petugas',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 2,
        ],
    ],

    'password_timeout' => 10800,
];
