<?php
namespace Lokielse\LaravelPinyin\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelPinyinFacade extends Facade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-pinyin';
    }
}