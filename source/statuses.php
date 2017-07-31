<?php

namespace statuses;

use Closure as closure;
use statuses\exceptions\alreadyMatchedException;
use statuses\exceptions\notMatchedException;

class statuses implements \agreed\statuses
{
	private $matched = [ ];

	public function match ( int $status ) : closure
	{
		if ( ! $this->matches ( $status ) )
			throw new notMatchedException ( $status );

		return $this->matched [ $status ];
	}

	public function matching ( int $status, closure $callback )
	{
		if ( $this->matches ( $status ) )
			throw new alreadyMatchedException ( $status );
		$this->matched [ $status ] = $callback;
	}

	public function matches ( int $status ) : bool
	{
		return ( array_key_exists ( $status, $this->matched ) ) ;
	}
}