<?php

declare(strict_types=1);

namespace Oneup\FaviconFetcher\Result;

class FaviconCollection
{
    /**
     * @var array<int, Favicon>
     */
    private array $items = [];

    public function add(Favicon $favicon): self
    {
        $this->items[] = $favicon;

        return $this;
    }

    /**
     * @return array<int, Favicon>
     */
    public function getAll(): array
    {
        return $this->items;
    }

    public function findOneByMinimumSize(int $width, int $height): ?Favicon
    {
        $match = null;

        foreach ($this->items as $item) {
            if ($item->getWidth() < $width || $item->getHeight() < $height) {
                continue;
            }

            // If no previous match was found, assign and search on
            if (null === $match) {
                $match = $item;

                continue;
            }

            // Find the smallest one in the set
            if ($match->getHeight() > $item->getHeight() || $match->getWidth() > $item->getWidth()) {
                $match = $item;
            }
        }

        return $match;
    }

    public function merge(self $collection): self
    {
        foreach ($collection->getAll() as $item) {
            $this->add($item);
        }

        return $this;
    }
}
