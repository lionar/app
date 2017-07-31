<?php

namespace app;

use exception;
use http\request;
use http\response;

class kernel
{
    private $routes = [ ];
    
    public function __construct ( array $routes )
    {
        $this->routes = $routes;    
    }
    
    public function handle ( request $request ) : response
    {
        $response = $this->call ( ( string ) $request );
        if ( ! $response instanceOf response )
            $response = $this->interpret ( $response );
        return $response;
    }
    
    private function interpret ( $result ) : response
    {
        return ( $result === null ) ?
            $this->handleMissing ( ) :
            $this->handleArbitrary ( $result );
    }
    
    private function call ( string $request )
    {
        if ( array_key_exists ( $request, $this->routes ) )
            return call_user_func ( $this->routes [ $request ] );
    }
    
    private function handleMissing ( ) : response
    {
        return $this->respond ( '<h1>The resource you where looking for does not exist.</h1>', 404, 'text/html' );
    }
    
    private function handleArbitrary ( $result ) : response
    {
        if ( is_string ( $result ) )
            return $this->handleString ( $result );
        if ( is_array ( $result ) )
            return $this->handleArray ( $result );
        throw new exception ( 'The return value of your route can not be handled by the kernel.' );
    }
    
    private function handleString ( string $result ) : response
    {
        $type = ( $result !== strip_tags ( $result ) ) 
            ? 'text/html' : 'text/plain';

        return $this->respond ( $result, 200, $type );
    }
    
    private function handleArray ( array $result ) : response
    {
        return $this->respond ( json_encode ( $result ), 200, 'application/json' );
    }
    
    private function respond ( string $content, int $status, string $type ) : response
    {
        $response = new response ( $content, $status );
        $response [ 'Content-Type' ] = $type;
        return $response;
    }
}