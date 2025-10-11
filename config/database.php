<?php

use Illuminate\Support\Str;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'pgsql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
        ],

        'CDG' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST_CDG'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATA'),
            'username' => env('DB_USER_EXTERNAL'),
            'password' => env('DB_PASS_EXTERNAL'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
            'options' => [
                \PDO::PGSQL_ATTR_DISABLE_PREPARES => false,
                PDO::ATTR_TIMEOUT => 5, // timeout de conexión
                'options' => "--statement_timeout=5000" // timeout de ejecución de consultas
            ]
        ],

        'CDO' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST_CDO'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATA'),
            'username' => env('DB_USER_EXTERNAL'),
            'password' => env('DB_PASS_EXTERNAL'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
            'options' => [
                \PDO::PGSQL_ATTR_DISABLE_PREPARES => false,
                PDO::ATTR_TIMEOUT => 5, // timeout de conexión
                'options' => "--statement_timeout=5000" // timeout de ejecución de consultas
            ]
        ],

        'CDE' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST_CDE'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATA'),
            'username' => env('DB_USER_EXTERNAL'),
            'password' => env('DB_PASS_EXTERNAL'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
            'options' => [
                \PDO::PGSQL_ATTR_DISABLE_PREPARES => false,
                PDO::ATTR_TIMEOUT => 5, // timeout de conexión
                'options' => "--statement_timeout=5000" // timeout de ejecución de consultas
            ]
        ],

        'CDA' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST_CDA'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATA'),
            'username' => env('DB_USER_EXTERNAL'),
            'password' => env('DB_PASS_EXTERNAL'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
            'options' => [
                \PDO::PGSQL_ATTR_DISABLE_PREPARES => false,
                PDO::ATTR_TIMEOUT => 5, // timeout de conexión
                'options' => "--statement_timeout=5000" // timeout de ejecución de consultas
            ]
        ],

        'CDEnc' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST_CDEnc'),
            'port' => env('DB_PORT'),
            'database' => env('DB_DATA'),
            'username' => env('DB_USER_EXTERNAL'),
            'password' => env('DB_PASS_EXTERNAL'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'search_path' => 'public',
            'sslmode' => 'prefer',
            'options' => [
                \PDO::PGSQL_ATTR_DISABLE_PREPARES => false,
                PDO::ATTR_TIMEOUT => 5, // timeout de conexión
                'options' => "--statement_timeout=5000" // timeout de ejecución de consultas
            ]
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => env('REDIS_CLIENT', 'phpredis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'redis'),
            'prefix' => env('REDIS_PREFIX', Str::slug(env('APP_NAME', 'laravel'), '_').'_database_'),
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_DB', '0'),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'username' => env('REDIS_USERNAME'),
            'password' => env('REDIS_PASSWORD'),
            'port' => env('REDIS_PORT', '6379'),
            'database' => env('REDIS_CACHE_DB', '1'),
        ],

    ],

];
