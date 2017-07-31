<?php

use app\container;
use app\kernel;
use http\redirector;
use http\request;

require __DIR__ . '/../vendor/autoload.php';

class trainer
{
    public $exercises = [ [ 'name' => 'Bench press' ], [ 'name' => 'Military press' ], [ 'name' => 'Squats' ] ];
}

class view
{
    public function make ( string $message )
    {
        return "<h1>$message</h1>";
    }
}

$routes =
[
    'GET /' => function ( )
    {
        return 'Hello world';
    },
    'GET /dashboard' => function ( view $view )
    {
        return $view->make ( 'Dashboard' );  
    },
    'GET /exercises' => function ( trainer $trainer )
    {
        return $trainer->exercises;
    },
    'GET /redirect' => function ( )
    {
        $redirect = new redirector ( 'http://lionar.dev' );
        return $redirect->to ( '/' );
    }
];

$request = new request ( '/dashboard' );
//$request = new request ( '/exercises', 'GET', [ 'Content-Type' => 'application/json' ] );
// $request = new request ( '/exercises' );


$kernel = new kernel ( $routes, new container );
$response = $kernel->handle ( $request );

$response->send ( );