<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher;

class Favicon
{
    public function __construct(
        public readonly string $path,
        public readonly string $size,
    ) {
    }
}
