<?php
return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds'      => 'database/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment'     => 'dev',
        'dev' => [
            'adapter' => 'mysql',
            'host'    => envs('DB_HOST'),
            'name'    => envs('DB_DATABASE'),
            'user'    => envs('DB_USERNAME'),
            'pass'    => envs('DB_PASSWORD'),
            'port'    => 3306,
            'charset' => 'utf8mb4'
        ]
    ]
];
