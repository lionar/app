<?php

namespace app;

use Closure as closure;
use Illuminate\Container\Container as base;
use input\collection as input;
use statuses\statuses;

class container extends base
{
	private $statuses = null;
	private $input = null;
	private $binders = [ ];

	public function __construct ( statuses $statuses, input $input )
	{
		$this->statuses = $statuses;
		$this->input = $input;
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
			$this->call ( $this->binders [ $abstract ], array_merge ( $parameters, $this->input->all ( ) ) ) :
			parent::make ( $abstract, $parameters );
	}

	public function fulfill ( string $abstract )
	{
		$response = $this->make ( $abstract );
		return $this->call ( $this->statuses->match ( $response [ 0 ] ), $response [ 1 ] );
	}
}