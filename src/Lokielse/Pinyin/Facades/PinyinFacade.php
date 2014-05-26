<?php namespace Jeepmac\Pinyinslug\Facades;

use Illuminate\Support\Facades\Facade;

class PinyinFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'pinyin';
    }
}