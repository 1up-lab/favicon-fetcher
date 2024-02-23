<?php

declare(strict_types=1);

namespace Test\Oneup\FaviconFetcher\Result;

use Oneup\FaviconFetcher\Result\Favicon;
use PHPUnit\Framework\TestCase;

class FaviconTest extends TestCase
{
    public function testDataRetrieval(): void
    {
        $url = 'https://1up.io';
        $width = 32;
        $height = 32;

        $favicon = new Favicon($url, $width, $height);

        $this->assertSame($url, $favicon->getUrl());
        $this->assertSame($height, $favicon->getHeight());
        $this->assertSame($width, $favicon->getWidth());
    }
}
