<?php

use app\container;
use app\statuses;


require __DIR__ . '/../vendor/autoload.php';

class_alias ( 'app\container', 'app' );


$status = new statuses;
$status->matching ( 1, function ( )
{
	echo 'HI HI HI';
} );


$container = new app ( $status, [ ] );


$container->instance ( 'app\container', $container );

$container->binding ( 'test feature', function ( )
{
	return [ 1, [ ] ];
} );

$container->call ( function ( container $app )
{
	$app->fulfill ( 'test feature' );
} );