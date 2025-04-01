<?php

declare(strict_types=1);

namespace ToolMountain\UriTranslator\Macros\Lang;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use ToolMountain\UriTranslator\UriTranslator;

final class UriMacro
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
