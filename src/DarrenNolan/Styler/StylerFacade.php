<?php namespace DarrenNolan\Styler;

use Illuminate\Support\Facades\Facade;

class StylerFacade extends Facade {

    protected static function getFacadeAccessor()
    {
        return 'styler';
    }

}
