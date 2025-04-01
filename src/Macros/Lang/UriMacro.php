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
     */
    public static function register(): void
    {
        Lang::macro('uri', function (string $uri, ?string $locale = null, ?string $namespace = null) {
            return App::make(UriTranslator::class)->translate($uri, $locale, $namespace);
        });
    }
}
