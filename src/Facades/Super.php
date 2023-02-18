<?php


namespace EngMahmoudElgml\Super\Facades;


class Super
{
    public static function resolveFacade($name){
        return app()[$name];
    }

    public static function __callStatic($methode, $arguments)
    {
        return (self::resolveFacade('Super'))->$methode(...$arguments);
    }
}
