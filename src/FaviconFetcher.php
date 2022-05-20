<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class FaviconFetcher
{
    public function __construct(
        private HttpClientInterface $client,
        private iterable $strategies,
    ) {
    }

    public function find(string $url, array $headers = []): FetcherResult
    {
        $response = $this->client->request('GET', $url, [
            'headers' => $headers,
        ]);

        $content = $response->getContent();

        libxml_clear_errors();
        $previous = libxml_use_internal_errors(true);

        $dom = new \DOMDocument();
        $dom->loadHTML($content, LIBXML_NOWARNING);

        $xpath = new \DOMXPath($dom);

        $results = [];

        /** @var StrategyInterface $strategy */
        foreach ($this->strategies as $strategy) {
            $results = [...$results, ...$strategy->find($url, $xpath)];
        }

        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        return new FetcherResult($results);
    }

    public function download(Favicon $favicon, array $headers = []): string
    {
        $response = $this->client->request('GET', $favicon->path, [
            'headers' => $headers,
        ]);

        return $response->getContent();
    }
}
