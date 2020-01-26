# Extension nette/caching to filipsedivy/cnb-api package

## Usage

```php
$storage = new \Nette\Caching\Storages\FileStorage(__DIR__ . '/temp');
$cache = new \Nette\Caching\Cache($storage);
$adapter = new \CnbApi\Caching\NetteCaching($cache);

$client = new \CnbApi\Client($adapter);
```
