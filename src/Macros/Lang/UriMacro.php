<?php

namespace ToolMountain\UriTranslator\Macros\Lang;

use ToolMountain\UriTranslator\UriTranslator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class UriMacro
{
    /**
     * Register the macro.
     *
     * @return void
     */
    public static function register()
    {
        Lang::macro('uri', function ($uri, $locale = null, $namespace = null) {
            return App::make(UriTranslator::class)->translate($uri, $locale, $namespace);
        });
    }
}
