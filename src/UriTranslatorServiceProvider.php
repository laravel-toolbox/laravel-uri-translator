<?php

declare(strict_types=1);

namespace ToolMountain\UriTranslator;

use Illuminate\Support\ServiceProvider;
use ToolMountain\UriTranslator\Macros\Lang\UriMacro;

final class UriTranslatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UriMacro::register();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
}
