<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Shell Command Execution
    |--------------------------------------------------------------------------
    */

    'commands' => [

        'log' => env('CLOUDPI_LOG_COMMANDS', true),

        'sudo' => env('CLOUDPI_USE_SUDO', false),

    ],

    /*
    |--------------------------------------------------------------------------
    | Nginx
    |--------------------------------------------------------------------------
    */

    'nginx' => [

        'sites_available' => env(
            'CLOUDPI_NGINX_SITES_AVAILABLE',
            '/etc/nginx/sites-available'
        ),

        'sites_enabled' => env(
            'CLOUDPI_NGINX_SITES_ENABLED',
            '/etc/nginx/sites-enabled'
        ),

    ],

    /*
    |--------------------------------------------------------------------------
    | Web Root
    |--------------------------------------------------------------------------
    */

    'web_root' => env(
        'CLOUDPI_WEB_ROOT',
        '/var/www'
    ),

];