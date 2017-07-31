<?php

use Illuminate\Container\Container;

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

$container = new Container;

$container->singleton ( 'trainer', function ( ) { return new trainer; } );
$container [ 'trainer' ]->remember ( new exercise ( 'Military press' ) );
$container [ 'trainer' ]->remember ( new exercise ( 'Bench press' ) );

var_dump ( $container [ 'trainer' ] );