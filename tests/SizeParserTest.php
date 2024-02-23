<?php

declare(strict_types=1);

namespace Test\Oneup\FaviconFetcher;

use Oneup\FaviconFetcher\SizeParser;
use PHPUnit\Framework\TestCase;

class SizeParserTest extends TestCase
{
    /**
     * @dataProvider provideUrls
     */
    public function testProvidedSizes(string $input, int $width, int $height): void
    {
        $sizeParser = new SizeParser();

        $this->assertSame([$width, $height], $sizeParser->parse($input));
    }

    public function testThrowsExceptionIfSizeContainsMoreThanTwoParts(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        (new SizeParser())->parse('10x10x10');
    }

    public function provideUrls(): array
    {
        return [
            ['16x16', 16, 16],
            ['32x32', 32, 32],
            ['180', 180, 180],
        ];
    }
}
