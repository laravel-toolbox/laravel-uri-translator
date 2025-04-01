<?php

declare(strict_types=1);

namespace ToolMountain\UriTranslator\Tests\Feature;

use Illuminate\Support\Facades\Lang;
use PHPUnit\Framework\Attributes\Test;
use ToolMountain\UriTranslator\Tests\TestCase;

final class UriTranslatorTest extends TestCase
{
    #[Test]
    public function it_translates_every_segment_in_a_uri_to_the_current_locale(): void
    {
        $this->setTranslations([
            'nl' => [
                'my' => 'mijn',
                'new' => 'nieuwe',
                'page' => 'pagina',
            ],
        ]);

        $this->setAppLocale('en');
        $this->assertSame('my/new/page', Lang::uri('my/new/page'));

        $this->setAppLocale('nl');
        $this->assertSame('mijn/nieuwe/pagina', Lang::uri('my/new/page'));
        $this->assertSame('mijn/nieuwe/pagina', trans()->uri('my/new/page'));
    }

    #[Test]
    public function it_translates_every_segment_in_a_uri_to_the_given_locale(): void
    {
        $this->setTranslations([
            'nl' => [
                'my' => 'mijn',
                'new' => 'nieuwe',
                'page' => 'pagina',
            ],
        ]);

        $this->assertSame('mijn/nieuwe/pagina', Lang::uri('my/new/page', 'nl'));
    }

    #[Test]
    public function it_uses_the_original_values_if_a_translation_does_not_exist(): void
    {
        $this->setTranslations([
            'nl' => [
                'my' => 'mijn',
                'new' => 'nieuwe',
            ],
        ]);

        $this->assertSame('mijn/nieuwe/page', Lang::uri('my/new/page', 'nl'));
        $this->assertSame('my/new/page', Lang::uri('my/new/page', 'fr'));
    }

    #[Test]
    public function it_ignores_trailing_slashes(): void
    {
        $this->setTranslations([
            'nl' => [
                'my' => 'mijn',
                'new' => 'nieuwe',
                'page' => 'pagina',
            ],
        ]);

        $this->assertSame('mijn/nieuwe/pagina', Lang::uri('/my/new/page/', 'nl'));
    }

    #[Test]
    public function it_skips_placeholders_in_a_uri(): void
    {
        $this->setTranslations([
            'nl' => [
                'articles' => 'artikels',
            ],
        ]);

        $this->assertSame('artikels/{articles}', Lang::uri('articles/{articles}', 'nl'));
    }

    #[Test]
    public function you_can_translate_a_full_uri(): void
    {
        $this->setTranslations([
            'nl' => [
                'glass' => 'glas',
                'products' => 'producten',
                'products/glass' => 'producten/glazen',
            ],
        ]);

        $this->assertSame('producten/glazen', Lang::uri('products/glass', 'nl'));
    }

    #[Test]
    public function you_can_translate_a_full_uri_with_placeholder(): void
    {
        $this->setTranslations([
            'nl' => [
                'glass' => 'glas',
                'products' => 'producten',
                'products/glass/{type}' => 'producten/glazen/{type}',
            ],
        ]);

        $this->assertSame('producten/glazen/{type}', Lang::uri('products/glass/{type}', 'nl'));
    }

    #[Test]
    public function you_can_specify_a_namespace(): void
    {
        $this->setTranslations([
            'nl' => [
                'articles' => 'artikels',
            ],
        ], 'blog');

        $this->assertSame('artikels/{article}', Lang::uri('articles/{article}', 'nl', 'blog'));
    }

    #[Test]
    public function the_uri_macro_is_available_via_the_trans_helper(): void
    {
        $this->setTranslations([
            'nl' => [
                'my' => 'mijn',
                'new' => 'nieuwe',
                'page' => 'pagina',
            ],
        ]);

        $this->setAppLocale('en');
        $this->assertSame('my/new/page', trans()->uri('my/new/page'));

        $this->setAppLocale('nl');
        $this->assertSame('mijn/nieuwe/pagina', trans()->uri('my/new/page'));
    }
}
