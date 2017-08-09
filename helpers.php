<?php

function requiring ( $directory, $app )
{
	$directory = new RecursiveDirectoryIterator ( $directory );
	$iterator = new RecursiveIteratorIterator ( $directory );
	$objects = new RegexIterator ( $iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH );
	foreach ( $objects as $directory )
	  	foreach ( $directory as $file )
	  		require $file;
}