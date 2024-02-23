<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher;

use Oneup\FaviconFetcher\Result\Favicon;
use Oneup\FaviconFetcher\Result\FaviconCollection;
use Oneup\FaviconFetcher\Strategy\StrategyInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class FaviconFetcher
{
    public function __construct(
        private readonly HttpClientInterface $client,
        private readonly iterable $strategies,
    ) {
    }

    public function fetch(string $url): FaviconCollection
    {
        $response = $this->client->request('GET', $url);
        $content = $response->getContent();

        libxml_clear_errors();
        $previous = libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML($content, \LIBXML_NOWARNING);

        $xpath = new \DOMXPath($dom);

        $collection = new FaviconCollection();

        /** @var StrategyInterface $strategy */
        foreach ($this->strategies as $strategy) {
            $collection->merge($strategy->find($url, $xpath));
        }

        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        return $collection;
    }

    public function download(Favicon $favicon): string
    {
        $response = $this->client->request('GET', $favicon->getUrl());

        return $response->getContent();
    }
}
