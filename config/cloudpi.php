<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Shell Command Execution
    |--------------------------------------------------------------------------
    */

    'commands' => [

        /*
         * Log every executed shell command.
         */
        'log' => env('CLOUDPI_LOG_COMMANDS', true),

        /*
         * Prefix all commands with sudo.
         */
        'sudo' => env('CLOUDPI_USE_SUDO', false),

    ],

];