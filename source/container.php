<?php

namespace app;

use Closure as closure;
use Illuminate\Container\Container as base;

class container extends base
{
	private $entities = [ ];
	private $input = [ ];

	public function __construct ( array $input = [ ] )
	{
		$this->input = $input;
	}

	public function binding ( string $abstract, closure $concrete )
	{
		$this->entities [ $abstract ] = $concrete;
	}

	public function share ( string $abstract, closure $concrete )
	{
		$this->bind ( $abstract, $concrete, true );
	}

	public function make ( $abstract, array $parameters = [ ] )
	{
		return ( array_key_exists ( $abstract, $this->entities ) ) ?
			$this->call ( $this->entities [ $abstract ], array_merge ( $parameters, $this->input ) ) :
			parent::make ( $abstract, $parameters );
	}
}