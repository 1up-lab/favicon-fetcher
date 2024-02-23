<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher;

use Spatie\Url\Url;

class UrlNormalizer
{
    public function normalize(string $href, string $host): string
    {
        $url = Url::fromString($href);

        if ('' === $url->getHost()) {
            $url = Url::fromString($host)->withPath($url->getPath());
        }

        return (string) $url;
    }
}
