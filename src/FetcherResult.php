<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher;

class FetcherResult
{
    public function __construct(
        private array $icons
    ) {
    }

    public function getClosestToSize(string $size): ?Favicon
    {
        $icons = $this->icons;

        usort($icons, function(Favicon $a, Favicon $b) use ($size) {
            if ($a->size === $b->size) {
                return 0;
            }

            $sizeA = (int) $a->size;
            $sizeB = (int) $b->size;
            $sizeSearch = (int) $size;

            return abs($sizeSearch - $sizeA) > abs($sizeSearch - $sizeB) ? 1 : -1;
        });

        if (0 === \count($icons)) {
            return null;
        }

        return $icons[0];
    }
}
