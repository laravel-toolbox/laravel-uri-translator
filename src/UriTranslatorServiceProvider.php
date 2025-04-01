<?php

declare(strict_types=1);

namespace ToolMountain\UriTranslator;

use Illuminate\Support\ServiceProvider;
use ToolMountain\UriTranslator\Macros\Lang\UriMacro;

final class UriTranslatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        UriMacro::register();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
