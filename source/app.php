<?php

namespace firestark;

use agreed\input;
use agreed\router;
use agreed\statuses;
use closure;
use Illuminate\Container\Container as container;

class app extends container
{
	private $router, $statuses, $input = null;
	private $binders = [ ];

	public function __construct ( router $router, statuses $statuses, input $input )
	{
		$this [ 'router' ] = $router;
		$this [ 'statuses' ] = $statuses;
		$this [ 'input' ] = $input;
	}

	public function route ( string $key, closure $task )
	{
		$this [ 'router' ]->add ( $key, $task );
	}

	public function status ( int $code, closure $task )
	{
		$this [ 'statuses' ]->matching ( $code, $task );
	}

	public function binding ( string $abstract, closure $concrete )
	{
		$this->binders [ $abstract ] = $concrete;
	}

	public function share ( string $abstract, closure $concrete )
	{
		$this->bind ( $abstract, $concrete, true );
	}

	public function make ( $abstract, array $parameters = [ ] )
	{
		return ( array_key_exists ( $abstract, $this->binders ) ) ?
			$this->call ( $this->binders [ $abstract ], array_merge ( $parameters, $this [ 'input' ]->all ( ) ) ) :
			parent::make ( $abstract, $parameters );
	}
	
	public function fulfill ( string $abstract )
	{
		$response = $this->call ( $this->binders [ $abstract ] );
		return $this->call ( $this [ 'statuses' ]->match ( $response [ 0 ] ), $response [ 1 ] );
	}
}