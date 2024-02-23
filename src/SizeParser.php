<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher;

class SizeParser
{
    /**
     * @return array<int, int>
     */
    public function parse(string $size): array
    {
        $dimensions = explode('x', $size);
        $dimensions = array_map(fn (string $dimension): int => (int) $dimension, $dimensions);

        if (1 === \count($dimensions)) {
            return [$dimensions[0], $dimensions[0]];
        }

        if (2 === \count($dimensions)) {
            return [$dimensions[0], $dimensions[1]];
        }

        throw new \InvalidArgumentException('Could not parse size');
    }
}
