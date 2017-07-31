<?php

use app\container;
use app\kernel;
use http\redirector;
use http\request;

require __DIR__ . '/../vendor/autoload.php';

class exercise
{
	public $name = '';

	public function __construct ( string $name )
	{
		$this->name = $name;
	}
}

class trainer
{
	private $exercises = [ ];

	public function remember ( exercise $exercise )
	{
		$this->exercises [ ] = $exercise;
	}
}

$container = new container ( [ 'name' => 'Bench press' ] );
$container->binding ( 'exercise', function ( $name )
{
	return new exercise ( $name );
} );

$container->singleton ( 'trainer', function ( ) { return new trainer; } );

$routes =
[
	'POST /exercises' => function ( trainer $trainer, exercise $exercise )
	{
		$trainer->remember ( $exercise );
		return '<h1>Remembered</h1>';
	}
];


$kernel = new kernel ( $routes, $container );
$response = $kernel->handle ( new request ( '/exercises', 'POST' ) );
$response->send ( );

var_dump ( $container [ 'trainer' ] );