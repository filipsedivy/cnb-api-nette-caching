<?php declare(strict_types=1);

namespace CnbApi\Caching;

use CnbApi\Entity;
use DateTimeInterface;
use Nette\Caching;

class NetteCaching implements ICaching
{
    private $cache;

    public function __construct(Caching\Cache $cache)
    {
        $this->cache = $cache;
    }

    public function load(DateTimeInterface $dateTime): ?Entity\ExchangeRate
    {
        $key = $dateTime->format('Y-m-d');
        $entity = $this->cache->load($key);

        return $entity === null ? null : unserialize($entity, ['allowed_classes' => true]);
    }

    public function save(DateTimeInterface $dateTime, Entity\ExchangeRate $entity): void
    {
        $key = $dateTime->format('Y-m-d');

        $this->cache->save($key, serialize($entity), [
            Caching\Cache::EXPIRE => '1 month'
        ]);
    }
}
