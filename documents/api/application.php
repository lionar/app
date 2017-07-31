<?php

when ( 'i want to add an exercise', then ( apply ( a ( 

function ( trainer $trainer, exercise $exercise )
{
	$status = $trainer->remember ( $exercise );
	return [ $status, [ 'exercise' => $exercise ] ];
} ) ) ) );