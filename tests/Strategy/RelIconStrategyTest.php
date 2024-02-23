<?php

declare(strict_types=1);

namespace Test\Oneup\FaviconFetcher\Strategy;

use Oneup\FaviconFetcher\SizeParser;
use Oneup\FaviconFetcher\Strategy\RelIconStrategy;
use Oneup\FaviconFetcher\UrlNormalizer;

class RelIconStrategyTest extends AbstractStrategyTestCase
{
    public function testIconRetrieval(): void
    {
        $strategy = new RelIconStrategy(new SizeParser(), new UrlNormalizer());
        $collection = $strategy->find('https://1up.io', $this->getXPath('icon.html'));

        $this->assertCount(2, $collection->getAll());
    }

    public function testIconRetrievalWithAbsoluteFaviconUrls(): void
    {
        $strategy = new RelIconStrategy(new SizeParser(), new UrlNormalizer());
        $collection = $strategy->find('https://1up.io', $this->getXPath('icon-absolute-urls.html'));

        $this->assertCount(2, $collection->getAll());
    }
}
