<?php

declare(strict_types=1);

namespace ToolMountain\UriTranslator\Tests;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Orchestra\Testbench\TestCase as BaseTestCase;
use ToolMountain\UriTranslator\UriTranslatorServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * Set the app locale.
     *
     * @param  string  $locale
     * @return void
     */
    protected function setAppLocale($locale)
    {
        App::setLocale($locale);
    }

    /**
     * Fake that we created a routes.php file in the 'lang' folder
     * for each language with the given translations.
     *
     * @param  string  $namespace
     * @return void
     */
    protected function setTranslations($translations, $namespace = '*')
    {
        Lang::setLoaded([
            $namespace => [
                'routes' => $translations,
            ],
        ]);
    }

    /**
     * Get the packages service providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            UriTranslatorServiceProvider::class,
        ];
    }
}
