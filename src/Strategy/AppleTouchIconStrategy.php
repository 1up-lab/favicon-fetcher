<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher\Strategy;

use Oneup\FaviconFetcher\Favicon;
use Oneup\FaviconFetcher\StrategyInterface;

class AppleTouchIconStrategy implements StrategyInterface
{
    public function find(string $url, \DOMXPath $xpath): array
    {
        $elements = $xpath->query('/html/head/link[starts-with(@rel, "apple-touch-icon")]');

        if (false === $elements) {
            return [];
        }

        $results = [];

        /** @var \DOMElement $element */
        foreach ($elements as $element) {
            $href = $element->attributes->getNamedItem('href')?->textContent;
            $size = $element->attributes->getNamedItem('sizes')?->textContent;

            $path = parse_url($href, PHP_URL_PATH);
            $href = sprintf('%s/%s', $url, ltrim($path, '/'));

            $results[] = new Favicon($href, $size);
        }

        return $results;
    }
}
