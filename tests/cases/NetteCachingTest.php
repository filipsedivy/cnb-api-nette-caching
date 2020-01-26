<?php declare(strict_types=1);

namespace Tests\Cases;

use CnbApi\Caching;
use CnbApi\Entity;
use DateTime;
use Nette;
use Tester\Assert;
use Tester\TestCase;

require_once __DIR__ . '/../bootstrap.php';

class NetteCachingTest extends TestCase
{
    private $caching;

    public function __construct()
    {
        $storage = new Nette\Caching\Storages\FileStorage(CACHE_DIR);
        $cache = new Nette\Caching\Cache($storage, 'Cnb.Api.Caching');

        $this->caching = new Caching\NetteCaching($cache);
    }

    public function testLoadMethod(): void
    {
        $date = new DateTime;

        Assert::null($this->caching->load($date));
    }

    public function testSaveMethod(): void
    {
        $date = new DateTime('2019-02-01');

        $entity = new Entity\ExchangeRate($date, 5);
        $this->caching->save($date, $entity);

        Assert::type(Entity\ExchangeRate::class, $this->caching->load($date));

        $cacheEntity = $this->caching->load($date);

        Assert::type(DateTime::class, $cacheEntity->getDate());
        Assert::type('int', $cacheEntity->getSerialNumber());
        Assert::equal($cacheEntity->getDate()->format('Y-m-d'), $date->format('Y-m-d'));
        Assert::equal($cacheEntity->getSerialNumber(), 5);

        Assert::null($this->caching->load(new DateTime('2019-02-02')));
    }
}

(new NetteCachingTest)->run();
