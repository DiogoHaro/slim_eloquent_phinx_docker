<?php
return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/app/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/app/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => 'curso-slim_mysql_1',
            'name' => 'slim',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => 'curso-slim_mysql_1',
            'name' => 'slim',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => 'curso-slim_mysql_1',
            'name' => 'slim',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3306',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
