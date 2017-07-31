<?php

use app\kernel;
use http\request;

require __DIR__ . '/../vendor/autoload.php';

$routes =
[
    'GET /' => function ( )
    {
        return 'Hello world';
    },
    'GET /dashboard' => function ( )
    {
        return '<h1>Dashboard</h1>';  
    },
    'GET /exercises' => function ( )
    {
        return [ [ 'name' => 'Bench press' ], [ 'name' => 'Military press' ], [ 'name' => 'Squats' ] ];
    }
];

$request = new request ( '/exercises', 'GET', [ 'Content-Type' => 'application/json' ] );

$kernel = new kernel ( $routes );
$response = $kernel->handle ( $request );

$response->send ( );