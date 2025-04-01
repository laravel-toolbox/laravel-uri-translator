<?php

declare(strict_types=1);

namespace ToolMountain\UriTranslator\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Orchestra\Testbench\TestCase as BaseTestCase;
use ToolMountain\UriTranslator\UriTranslatorServiceProvider;

abstract class TestCase extends BaseTestCase
{
    /**
     * Set the app locale.
     */
    protected function setAppLocale(string $locale): void
    {
        App::setLocale($locale);
    }

    /**
     * Fake that we created a routes.php file in the 'lang' folder
     * for each language with the given translations.
     */
    protected function setTranslations(array $translations, string $namespace = '*'): void
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
     * @param  Application  $app
     */
    protected function getPackageProviders($app): array
    {
        return [
            UriTranslatorServiceProvider::class,
        ];
    }
}
