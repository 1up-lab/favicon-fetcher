<?php

declare(strict_types=1);

namespace Test\Oneup\FaviconFetcher;

use Oneup\FaviconFetcher\UrlNormalizer;
use PHPUnit\Framework\TestCase;

class UrlNormalizerTest extends TestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testProvidedUrls(string $url, string $href, string $output): void
    {
        $normalizer = new UrlNormalizer();

        $this->assertSame($output, $normalizer->normalize($href, $url));
    }

    public function provideUrls(): array
    {
        return [
            ['https://1up.io', '/favicon.png', 'https://1up.io/favicon.png'],
            ['https://1up.io', '/icons/favicon.png', 'https://1up.io/icons/favicon.png'],
            ['https://1up.io', 'favicon.png', 'https://1up.io/favicon.png'],
            ['https://1up.io', 'icons/favicon.png', 'https://1up.io/icons/favicon.png'],
            ['https://1up.io', 'https://cdn.1up.io/icons/favicon.png', 'https://cdn.1up.io/icons/favicon.png'],
        ];
    }
}
