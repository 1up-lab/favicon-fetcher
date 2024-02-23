<?php

declare(strict_types=1);

namespace Test\Oneup\FaviconFetcher\Strategy;

use Oneup\FaviconFetcher\SizeParser;
use Oneup\FaviconFetcher\Strategy\AppleTouchIconStrategy;
use Oneup\FaviconFetcher\UrlNormalizer;

class AppleTouchIconStrategyTest extends AbstractStrategyTestCase
{
    public function testIconRetrieval(): void
    {
        $strategy = new AppleTouchIconStrategy(new SizeParser(), new UrlNormalizer());
        $collection = $strategy->find('https://1up.io', $this->getXPath('apple-touch-icon.html'));

        $this->assertCount(8, $collection->getAll());
    }
}
