<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher;

interface StrategyInterface
{
    public function find(string $url, \DOMXPath $xpath): array;
}
