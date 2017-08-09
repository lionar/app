<?php

use Closure as closure;

function when ( string $feature, closure $action )
{
	global $app;
	$app->binding ( $feature, $action );
}

function then ( $a )
{
	return $a;
}

function apply ( $a )
{
	return $a;
}

function a ( $a )
{
	return $a;
}