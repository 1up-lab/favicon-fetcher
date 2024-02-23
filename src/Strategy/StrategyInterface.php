<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher\Strategy;

use Oneup\FaviconFetcher\Result\FaviconCollection;

interface StrategyInterface
{
    public function find(string $url, \DOMXPath $xpath): FaviconCollection;
}
