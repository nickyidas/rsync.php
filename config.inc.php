<?php

/**
 * @see https://github.com/yidas/deployer-php-cli
 */

return [
    'default' => [
        'servers' => [
            '127.0.0.1',
        ],
        'user' => [
            'local' => '',
            'remote' => '',
        ],
        'source' => '/var/www/html/project',
        'destination' => '/var/www/html/test/',
        'exclude' => [
            '.git',
        ],
        'git' => [
            'enabled' => true,
            'path' => './',
            'checkout' => true,
            'branch' => 'master',
        ],
        'composer' => [
            'enabled' => true,
            'path' => './',
            'command' => 'composer update',
        ],
        'rsync' => [
            'params' => '-av --delete',
            'sleepSeconds' => 0,
        ],
        'commands' => [
            'before' => [
                '',
            ],
        ],
        'verbose' => false,
    ],
];
