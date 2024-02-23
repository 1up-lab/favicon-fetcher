# PHP Favicon Fetcher

```php
use Oneup\FaviconFetcher\FaviconFetcher;
use Oneup\FaviconFetcher\SizeParser;
use Oneup\FaviconFetcher\Strategy\RelIconStrategy;
use Oneup\FaviconFetcher\Strategy\AppleTouchIconStrategy;
use Oneup\FaviconFetcher\UrlNormalizer;

$httpClient = ...

$sizeParser = new SizeParser();
$urlNormalizer = new UrlNormalizer();

$faviconFetcher = new FaviconFetcher($httpClient, [
    new RelIconStrategy($sizeParser, $urlNormalizer),
    new AppleTouchIconStrategy($sizeParser, $urlNormalizer),
]);

$collection = $faviconFetcher->fetch('https://1up.io');
$favicon = $collection->findOneByMinimumSize(32, 32);

$contents = $faviconFetcher->download($favicon);
```
