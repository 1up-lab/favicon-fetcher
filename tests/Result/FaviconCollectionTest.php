<?php

declare(strict_types=1);

namespace Test\Oneup\FaviconFetcher\Result;

use Oneup\FaviconFetcher\Result\Favicon;
use Oneup\FaviconFetcher\Result\FaviconCollection;
use PHPUnit\Framework\TestCase;

class FaviconCollectionTest extends TestCase
{
    public function testGetAll(): void
    {
        $collection = new FaviconCollection();
        $collection->add(new Favicon('a', 1, 1));
        $collection->add(new Favicon('b', 2, 2));
        $collection->add(new Favicon('c', 3, 3));

        $this->assertCount(3, $collection->getAll());
        $this->assertContainsOnlyInstancesOf(Favicon::class, $collection->getAll());
    }

    public function testFindByMinimalSize(): void
    {
        $collection = new FaviconCollection();
        $collection->add(new Favicon('z', 9, 9));
        $collection->add(new Favicon('a', 1, 1));
        $collection->add(new Favicon('b', 2, 2));
        $collection->add(new Favicon('c', 3, 3));
        $collection->add(new Favicon('d', 4, 4));

        $favicon = $collection->findOneByMinimumSize(2, 2);

        $this->assertSame('b', $favicon->getUrl());
    }

    public function testMerge(): void
    {
        $collection1 = (new FaviconCollection())->add(new Favicon('a', 1, 1));
        $collection2 = (new FaviconCollection())->add(new Favicon('b', 2, 2));

        $merged = (new FaviconCollection())
            ->merge($collection1)
            ->merge($collection2)
        ;

        $this->assertCount(2, $merged->getAll());
        $this->assertContainsOnlyInstancesOf(Favicon::class, $merged->getAll());
    }
}
