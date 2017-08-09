<?php

use routing\router;
use statuses\collection as statuses;
use input\collection as input;

require __DIR__ . '/../vendor/autoload.php';

$app = new firestark\app ( new router, new statuses, new input );

$app [ 'test' ] = 'Hi test';

$app->route ( 'GET /', function ( ) use ( $app )
{
	return $app [ 'test' ];
} );

dd ( $app [ 'router' ]->match ( 'GET /' ) ( ) );