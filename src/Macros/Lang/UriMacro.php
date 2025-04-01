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
        Lang::macro('uri', fn ($uri, $locale = null, $namespace = null) => App::make(UriTranslator::class)->translate($uri, $locale, $namespace));
    }
}
