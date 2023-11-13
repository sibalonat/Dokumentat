<?php

namespace Keysoft\Dokumentat\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Keysoft\Dokumentat\Dokumentat
 */
class Dokumentat extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Keysoft\Dokumentat\Dokumentat::class;
    }
}
