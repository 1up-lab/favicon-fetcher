<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher\Result;

class Favicon
{
    public function __construct(
        private readonly string $url,
        private readonly int $width,
        private readonly int $height,
    ) {
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getWidth(): int
    {
        return $this->width;
    }

    public function getHeight(): int
    {
        return $this->height;
    }
}
