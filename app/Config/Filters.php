<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use CodeIgniter\Filters\InvalidChars;
use CodeIgniter\Filters\SecureHeaders;

class Filters extends BaseConfig
{
    /**
     * Configures aliases for Filter classes to
     * make reading things nicer and simpler.
     *
     * @var array
     */
    public $aliases = [
        'csrf'          => CSRF::class,
        'toolbar'       => DebugToolbar::class,
        'honeypot'      => Honeypot::class,
        'invalidchars'  => InvalidChars::class,
        'secureheaders' => SecureHeaders::class,
        'filterAdmin'     => \App\Filters\FilterAdmin::class,
        'filterPerawat'     => \App\Filters\FilterPerawat::class,
        'filterDokter'     => \App\Filters\FilterDokter::class,
        'filterApoteker'     => \App\Filters\FilterApoteker::class,
    ];

    /**
     * List of filter aliases that are always
     * applied before and after every request.
     *
     * @var array
     */
    public $globals = [
        'before' => [
            'filterAdmin' => [
                'except' => [
                    'Home', 'Home/*',
                    '/',
                ]
            ],
            'filterPerawat' => [
                'except' => [
                    'Home', 'Home/*',
                    '/',
                ]
            ],
            'filterPerawat' => [
                'except' => [
                    'Home', 'Home/*',
                    '/',
                ]
            ],
            'filterApoteker' => [
                'except' => [
                    'Home', 'Home/*',
                    '/',
                ]
            ],
            // 'honeypot',
            // 'csrf',
            // 'invalidchars',
        ],
        'after' => [
            'filterAdmin' => ['except' => [
                'Admin/*',
            ]],
            'filterPerawat' => ['except' => [
                'Perawat/*',
            ]],
            'filterDokter' => ['except' => [
                'Dokter/*',
            ]],
            'filterApoteker' => ['except' => [
                'Apoteker/*',
            ]],
            'toolbar',
            // 'honeypot',
            // 'secureheaders',
        ],
    ];

    /**
     * List of filter aliases that works on a
     * particular HTTP method (GET, POST, etc.).
     *
     * Example:
     * 'post' => ['csrf', 'throttle']
     *
     * @var array
     */
    public $methods = [];

    /**
     * List of filter aliases that should run on any
     * before or after URI patterns.
     *
     * Example:
     * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
     *
     * @var array
     */
    public $filters = [];
}
