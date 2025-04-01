<?php

declare(strict_types=1);

namespace ToolMountain\UriTranslator;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Str;

final class UriTranslator
{
    /**
     * Translate a URI.
     */
    public function translate(string $uri, ?string $locale = null, ?string $namespace = null): string
    {
        $fullUriKey = $this->buildTranslationKey($uri, $namespace);

        // Attempt to translate the full URI.
        if (Lang::has($fullUriKey, $locale)) {
            return Lang::get($fullUriKey, [], $locale);
        }

        $segments = $this->splitUriIntoSegments($uri);

        // Attempt to translate each segment individually. If there is no translation
        // for a specific segment, then its original value will be used.
        $translations = $segments->map(function ($segment) use ($locale, $namespace) {
            $segmentKey = $this->buildTranslationKey($segment, $namespace);

            // If the segment is not a placeholder and the segment
            // has a translation, then update the segment.
            if (! Str::startsWith($segment, '{') && Lang::has($segmentKey, $locale)) {
                $segment = Lang::get($segmentKey, [], $locale);
            }

            return $segment;
        });

        // Rebuild the URI from the translated segments.
        return $translations->implode('/');
    }

    /**
     * Split the URI into a Collection of segments.
     */
    protected function splitUriIntoSegments(string $uri): Collection
    {
        $uri = trim($uri, '/');
        $segments = explode('/', $uri);

        return Collection::make($segments);
    }

    /**
     * Build a translation key, including the namespace and file name.
     */
    protected function buildTranslationKey(string $key, ?string $namespace): string
    {
        $namespace = $namespace ? "{$namespace}::" : '';
        $file = $this->getTranslationFileName();

        return "{$namespace}{$file}.{$key}";
    }

    /**
     * Get the file name that holds the URI translations.
     */
    protected function getTranslationFileName(): string
    {
        return 'routes';
    }
}
