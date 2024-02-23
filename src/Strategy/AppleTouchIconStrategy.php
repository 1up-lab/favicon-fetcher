<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher\Strategy;

use Oneup\FaviconFetcher\Result\Favicon;
use Oneup\FaviconFetcher\Result\FaviconCollection;
use Oneup\FaviconFetcher\SizeParser;
use Oneup\FaviconFetcher\UrlNormalizer;

class AppleTouchIconStrategy implements StrategyInterface
{
    public function __construct(
        private readonly SizeParser $sizeParser,
        private readonly UrlNormalizer $urlNormalizer,
    ) {
    }

    public function find(string $url, \DOMXPath $xpath): FaviconCollection
    {
        $collection = new FaviconCollection();
        $elements = $xpath->query('/html/head/link[starts-with(@rel, "apple-touch-icon")]');

        if (false === $elements) {
            return $collection;
        }

        /** @var \DOMElement $element */
        foreach ($elements as $element) {
            $href = (string) $element->attributes->getNamedItem('href')?->textContent;
            $size = (string) $element->attributes->getNamedItem('sizes')?->textContent;

            try {
                [$width, $height] = $this->sizeParser->parse($size);
            } catch (\InvalidArgumentException) {
                continue;
            }

            $href = $this->urlNormalizer->normalize($href, $url);

            $collection->add(new Favicon($href, $width, $height));
        }

        return $collection;
    }
}
