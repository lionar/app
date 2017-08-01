<?php

abstract class facade
{
    protected static $app;
    protected static function getFacadeAccessor ( ) : string
    {
        throw new RuntimeException ( 'Facade does not implement getFacadeAccessor method.' );
    }
    protected static function resolveFacadeInstance ( )
    {
        return static::$app->make ( static::getFacadeAccessor ( ) );
    }
    public static function setFacadeApplication ( $app )
    {
        static::$app = $app;
    }
    public static function __callStatic ( $method, $args )
    {
        $instance = static::resolveFacadeInstance ( );
        if ( ! $instance )
            throw new RuntimeException ( 'A facade root has not been set.' );
        return $instance->$method ( ...$args );
    }
}