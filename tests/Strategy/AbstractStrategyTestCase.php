<?php

declare(strict_types=1);

namespace Test\Oneup\FaviconFetcher\Strategy;

use PHPUnit\Framework\TestCase;

abstract class AbstractStrategyTestCase extends TestCase
{
    protected function getXPath(string $testFile): \DOMXPath
    {
        $content = file_get_contents(__DIR__ . '/../Resources/' . $testFile);

        $dom = new \DOMDocument();
        $dom->loadHTML($content, \LIBXML_NOWARNING);

        return new \DOMXPath($dom);
    }
}
