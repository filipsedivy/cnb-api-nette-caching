# filipsedivy/cnb-api-nette-caching

## Usage

```php
$storage = new \Nette\Caching\Storages\FileStorage(__DIR__ . '/temp');
$cache = new \Nette\Caching\Cache($storage);
$cnbCache = new \CnbApi\Caching\NetteCaching($cache);

$client = new \CnbApi\Client($cnbCache);
```
