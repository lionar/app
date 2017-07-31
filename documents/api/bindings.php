<?php

app::bind ( 'exercise', function ( $name )
{
	return new exercise ( $name );
} );